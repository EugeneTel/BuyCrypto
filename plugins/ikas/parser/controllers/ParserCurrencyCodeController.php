<?php namespace Ikas\Parser\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Ikas\Parser\Models\BchCurrency;
use Ikas\Parser\Models\CrypCurrency;
use Ikas\Parser\Models\ParserCurrencyCode;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Laradev\Crypto\Models\Currency;
use October\Rain\Support\Facades\Flash;

class ParserCurrencyCodeController extends Controller
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
        BackendMenu::setContext('Ikas.Parser', 'parser', 'associations');
    }

    public function index()
    {
        $this->vars["buycrypto"]["currency"] = Currency::all()->pluck('name', 'id')->toArray();
        $this->vars["cryptowatch"]["currency"] = CrypCurrency::all()->pluck('name', 'id')->toArray();
        $this->vars["bestchange"]["currency"] = BchCurrency::all()->pluck('name', 'id')->toArray();
        $this->vars["currecyTable"] = ParserCurrencyCode::all()->toArray();
    }

    public function onSaveAssociationCurrency()
    {
        $buycryptoId = Input::get('buycrypto')[0];
        $cryptowatchId = Input::get('cryptowatch')[0];
        $bestchangeId = Input::get('bestchange')[0];

        if ($cryptowatchId) {
            $assocCurrency = $cryptowatchId;
            $resource = 'crypto_watch';
        }
        if ($bestchangeId) {
            $assocCurrency = $bestchangeId;
            $resource = 'best_change';
        }
        $model = ParserCurrencyCode::where('buy_currency_id', $buycryptoId);
        if (!empty($model->get()->toArray())) {
            $model->update(['out_id' => $assocCurrency, 'resource' => $resource]);
            Flash::info('Update');
        } else {
            $model = new ParserCurrencyCode();
            $model->buy_currency_id = $buycryptoId;
            $model->out_id = $assocCurrency;
            $model->resource = $resource;
            $model->save();
            Flash::info('Save');
        }

        $this->vars["currecyTable"] = ParserCurrencyCode::all()->toArray();

        return Redirect::to('backend/ikas/parser/parsercurrencycodecontroller');

    }
    
}