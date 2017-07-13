<?php namespace Ikas\Parser\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Ikas\Parser\Models\BchCurrency;
use Ikas\Parser\Models\BchCurrencyCode;
use Ikas\Parser\Models\BchExchange;
use Ikas\Parser\Models\Bestchange;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use October\Rain\Support\Facades\Flash;

class BestchangeController extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController'
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $fileDirUnzip;
    public $files;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ikas.Parser', 'parser', 'bestchange');
    }

    public function parseStart()
    {

        if ($this->unzipDir()) {
            $contents = $this->readFile();
            $this->saveData($contents);
        };

    }

    public function unzipDir()
    {

        try {

            $fileSource = Settings::get('bestchange.file_dir.source.info');
            $fileDir = Settings::get('bestchange.file_dir.info');
            $this->fileDirUnzip = Settings::get('bestchange.file_dir.unzip.info');

            copy($fileSource, $fileDir);

            if (file_exists($fileDir)) {
                $zip = new \ZipArchive();
                $zip->open($fileDir);

                if (!file_exists($this->fileDirUnzip)) {
                    mkdir($this->fileDirUnzip);
                    chmod($this->fileDirUnzip, 0777);
                }

                $zip->extractTo($this->fileDirUnzip);
                $zip->close();

                $files = scandir($this->fileDirUnzip);

                foreach ($files as $file) {
                    if ($file != '.' and $file != '..') {
                        chmod($this->fileDirUnzip . $file, 0777);
                    }
                }
            }
        } catch (\Exception $e) {
            \Flash::error('Unzip file error:' . $e->getMessage());
            Log::error($e);
            return false;
        }
        return true;
    }

    public function readFile()
    {

        $this->files = Settings::get('bestchange.file_list.parse');

        if (!$this->files) {
            \Flash::error('No selected files');
            return false;
        }

        $contents = [];

        $this->files = explode('|', $this->files);
        foreach ($this->files as $file) {
            try {
                if (file_exists($this->fileDirUnzip . $file)) {
                    $contents[$file] = iconv('windows-1251',
                    mb_detect_encoding(File::get($this->fileDirUnzip . $file)) . '//TRANSLIT',
                    File::get($this->fileDirUnzip . $file));
                    $contents[$file] = explode(PHP_EOL, $contents[$file]);
                    foreach ($contents[$file] as $kay => $content){
                        $contents[$file][$kay] = explode(';', $content);
                    }
                }
            } catch (\Exception $e) {
                Flash::error($e->getMessage());
                Log::error($e);
                return false;
            };

        }

        return $contents;
    }

    public function saveData($data = [])
    {
        if (empty($data)) {
            \Flash::error('No data for save');
            return false;
        }

        if (in_array('bm_bcodes.dat', $this->files)){
            $this->saveCurrencyCode($data);
        }

        if (in_array('bm_cy.dat', $this->files)){
            $this->saveCurrency($data);
        }

        if (in_array('bm_exch.dat', $this->files)){
            $this->saveExchange($data);
        }
        if (in_array('bm_rates.dat', $this->files)){
            $this->saveBestchange($data);
        }
    }

    public function saveCurrencyCode($data = []){

        $contents = $data['bm_bcodes.dat'];

        if(empty($contents)){
            return false;
        }

        foreach ($contents as $row){
            if(empty($code = BchCurrencyCode::find($row[0]))){
                $code = new BchCurrencyCode();
                $code->id = $row[0];
                $code->code = $row[1];
                $code->name = $row[2];
                $code->save();
            } else {
                $code->update([
                    'code' => $row[1],
                    'name' => $row[2]
                ]);
            };
        }
    }

    public function saveCurrency($data = []){

        $contents = $data['bm_cy.dat'];

        if(empty($contents)){
            return false;
        }

        foreach ($contents as $row){
            if(empty($money = BchCurrency::find($row[0]))){
                $money = new BchCurrency();
                $money->id = $row[0];
                $money->x1 = $row[1];
                $money->name = $row[2];
                $money->code = $row[3];
                $money->bch_currency_codes_id = $row[4];
                $money->save();
            } else {
                $money->update([
                    'id' => $row[0],
                    'x1' => $row[1],
                    'name' => $row[2],
                    'code' => $row[3],
                    'bch_currency_codes_id' => $row[4],
                ]);
            };
        }
    }

    public function saveExchange($data = []){

        $contents = $data['bm_exch.dat'];

        if(empty($contents)){
            return false;
        }

        foreach ($contents as $row){
            try{
                if(empty($exch = BchExchange::find($row[0]))){
                    $exch = new BchExchange();
                    $exch->id = $row[0];
                    $exch->name = $row[1];
                    $exch->save();
                } else {
                    $exch->update([
                        'name' => $row[1]
                    ]);
                };
            } catch (\Exception $e){
                Log::error($e);
            }

        }

    }

    public function saveBestchange($data = []){

        $contents = $data['bm_rates.dat'];

        if(empty($contents)){
            return false;
        }
        set_time_limit(600);
        foreach ($contents as $row){
            $bch = Bestchange::where('from', $row[0])->where('to', $row[1])->where('bch_exchanges_id', $row[2]);
            if(empty($bch->get()->toArray())){
                $bch = new Bestchange();
                $bch->from = $row[0];
                $bch->to = $row[1];
                $bch->bch_exchanges_id = $row[2];
                $bch->amount = $row[3];
                $bch->from_rate = $row[4];
                $bch->to_rate = $row[5];
                $bch->save();
            } else {
                $bch->update([
                    'from' => $row[0],
                    'to' => $row[1],
                    'bch_exchanges_id' => $row[2],
                    'amount' => $row[3],
                    'from_rate' => $row[4],
                    'to_rate' => $row[5],
                ]);
            };
        }
        set_time_limit(30);

    }

    public function paginate($page){

        $pagination = Bestchange::paginate(15, $page);


        $this->vars['paginate'] = $pagination->toArray();
    }

}