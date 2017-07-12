<?php namespace Ikas\Parser\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Log;

class BestchangeController extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $fileDirUnzip;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ikas.Parser', 'parser', 'bestchange');
    }

    public function parseStart(){
        if($this->unzipDir()){
            $contents = $this->readFile();
        };

    }

    public function unzipDir(){

        try{

            $fileSource = Settings::get('bestchange.file_dir.source.info');
            $fileDir = Settings::get('bestchange.file_dir.info');
            $this->fileDirUnzip = Settings::get('bestchange.file_dir.unzip.info');

            copy($fileSource, $fileDir);

            if (file_exists($fileDir)){
                $zip = new \ZipArchive();
                $zip->open($fileDir);

                if (!file_exists($this->fileDirUnzip)){
                    mkdir($this->fileDirUnzip);
                    chmod($this->fileDirUnzip, 0777);
                }

                $zip->extractTo($this->fileDirUnzip);
                $zip->close();

                $files = scandir($this->fileDirUnzip);

                foreach ($files as $file){
                    if ($file != '.' and $file != '..'){
                        chmod($this->fileDirUnzip . $file, 0777);
                    }
                }
            }
        } catch (\Exception $e){
            \Flash::error('Unzip file error:' . $e->getMessage());
            Log::error($e);
            return false;
        }
        return true;
    }

    public function readFile(){

        $files = Settings::get('bestchange.file_list.parse');

        if (!$files){
            \Flash::error('No selected files');
            return false;
        }

    }

}