<?php namespace Ikas\Parser\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Ikas\Parser\Models\Settings as SettingsModel;
use Illuminate\Support\Facades\Log;

class BestchangeController extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ikas.Parser', 'parser', 'bestchange');
    }

    public function parseStart(){
        $this->unzipDir();
    }

    public function unzipDir(){

        try{

            $fileDir = Settings::get('bestchange.file_dir.info');
            $fileDirUnzip = Settings::get('bestchange.file_dir.unzip.info');

            if (file_exists($fileDir)){
                $zip = new \ZipArchive();
                $zip->open($fileDir);

                if (!file_exists($fileDirUnzip)){
                    mkdir($fileDirUnzip);
                    chmod($fileDirUnzip, 0777);
                }

                $zip->extractTo($fileDirUnzip);
                $zip->close();

                $files = scandir($fileDirUnzip);
                
                foreach ($files as $file){
                    if ($file != '.' and $file != '..'){
                        chmod($fileDirUnzip . $file, 0777);
                    }
                }
            }
        } catch (\Exception $e){
            \Flash::error('Unzip file error:' . $e->getMessage());
            Log::error($e);
        }

    }

}