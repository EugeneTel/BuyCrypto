<?php namespace Ikas\Parser\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Ikas\Parser\Models\Settings as SettingsModel;

class Settings extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController'
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ikas.Parser', 'parser', 'settings');
    }

    /**
     * Return all values if $name = null
     * @param null $name
     * @return mixed
     */
    static function get($name = null)
    {
        if ($name) {
            $setting = SettingsModel::where('name', $name)->first();
            if (!is_object($setting)) {
                \Flash::error('No setting [ ' . $name . ' ] in table');
                return false;
            }

            if(empty($value = $setting->value)){
                $value = $setting->default;
            }

            return $value;

        } else {
            $settings = SettingsModel::get();
            return $settings->pluck('value', 'name')->toArray();
        }
    }

}