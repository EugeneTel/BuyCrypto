<?php namespace Laradev\Crypto\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Input;
use Laradev\Crypto\Models\Currency;
use Laradev\Crypto\Models\Offer;
use Laradev\Crypto\Models\Way;

class OfferController extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Laradev.Crypto', 'crypto', 'offer');
    }

    public function index(){
        if (Input::get('from') == '0' || Input::get('to') == '0' || empty(Input::get('from')) || empty(Input::get('from'))){
            $pagination = Offer::with('offerSteps')->paginate(15);
        } else {
            $pagination = Offer::with('offerSteps')
                ->whereHas('way', function ($q){
                    $q->where('currency_from', Input::get('from'))->where('currency_to', Input::get('to'));
                })
                ->paginate(15);
        }

        $data = $pagination->items();

        $this->vars['paginate'] = $pagination->toArray();
        $this->vars['paginate']['data'] = $data;

        $this->vars['paginate']['first_page_url'] = $pagination->url(1) . "&from=" . Input::get('from') . "&to=" . Input::get('to');
        $this->vars['paginate']['last_page_url'] = $pagination->url($pagination->lastPage()) . "&from=" . Input::get('from') . "&to=" . Input::get('to');

        if($this->vars['paginate']['prev_page_url']){
            $this->vars['paginate']['prev_page_url'] = $this->vars['paginate']['prev_page_url'] . "&from=" . Input::get('from') . "&to=" . Input::get('to');
        } else {
            $this->vars['paginate']['prev_page_url'] = '';
        }
        if ($this->vars['paginate']['next_page_url']){
            $this->vars['paginate']['next_page_url'] = $this->vars['paginate']['next_page_url'] . "&from=" . Input::get('from') . "&to=" . Input::get('to');
        } else {
            $this->vars['paginate']['next_page_url'] = '';
        }

        $this->vars['currency'] = array_merge(['0' => 'Select currency'], Currency::get()->pluck('name', 'id')->toArray());
        $this->vars['input']['from'] = Input::get('from');
        $this->vars['input']['to'] = Input::get('to');

    }

}