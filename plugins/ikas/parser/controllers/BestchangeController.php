<?php namespace Ikas\Parser\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

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
        $zip = new \ZipArchive();
        $zip->open('storage/temp/public/info.zip');
        $zip->extractTo('storage/temp/public/exchange/');
        $zip->close();
    }
}