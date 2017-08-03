<?php namespace Ikas\Parser\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Ikas\Parser\Models\CrypCurrency;
use Ikas\Parser\Models\CrypPairs;
use Ikas\Parser\Models\CrypProvider;
use Ikas\Parser\Models\CryptowatchData;
use Illuminate\Support\Facades\Log;
use Laradev\Crypto\Models\Currency;

class CryptowatchController extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ikas.Parser', 'parser', 'cryptowatch-data');
    }


    public $priceUrl = 'https://api.cryptowat.ch/markets/prices';
    public $currencyUrl = 'https://api.cryptowat.ch/assets';
    public $pairUrl = 'https://api.cryptowat.ch/pairs';
    public $exchengeUrl = 'https://api.cryptowat.ch/exchanges';

    public function parse(){

        $currencies = $this->getDataByUrl($this->currencyUrl);
        $this->saveCurrency($currencies);
        $pairs = $this->getDataByUrl($this->pairUrl);
        $this->savePair($pairs);
        $providers = $this->getDataByUrl($this->exchengeUrl);
        $this->saveProvider($providers);
        $prices = $this->getDataByUrl($this->priceUrl);
        $this->savePrice($prices);

        return redirect()->back();
    }

    public function saveCurrency($data){
        CrypCurrency::getQuery()->delete();
        foreach ($data as $row){
            try{
                $currency = new CrypCurrency();
                $currency->id = $row['id'];
                $currency->name = $row['name'];
                $currency->fiat = $row['fiat'];
                $currency->route = $row['route'];
                $currency->save();
            } catch (\Exception $e){
                Log::error($e);
            }
        }
    }

    public function savePair($data){
        CrypPairs::getQuery()->delete();
        foreach ($data as $row){
            try{
                $pair = new CrypPairs();
                $pair->id = $row['id'];
                $pair->from_id = $row['base']['id'];
                $pair->to_id = $row['quote']['id'];
                $pair->save();
            } catch (\Exception $e){
                Log::error($e);
            }
        }
    }

    public function saveProvider($data){
        CrypProvider::getQuery()->delete();
        foreach ($data as $row){
            try{
                $provider = new CrypProvider();
                $provider->id = $row['id'];
                $provider->name = $row['name'];
                $provider->active = $row['active'];
                $provider->route = $row['route'];
                $provider->save();
            } catch (\Exception $e){
                Log::error($e);
            }
        }
    }

    public function getDataByUrl($url){
        try{
            $data = json_decode(file_get_contents($url), true);
            if (!empty($data['result'])){
                return $data['result'];
            }

        } catch (\Exception $e){
            \Flash::error($e->getMessage());
            Log::error($e);
        }
    }

    public function prepareDataPrice($data){
        $dataForSave = [];
        foreach ($data as $key => $price){
            $exchangePair = explode(':', $key);
            $row = [
                'exchange' => $exchangePair[0],
                'currency_pair' => $exchangePair[1],
                'price' => $price
            ];
            $dataForSave[] = $row;
        };
        return $dataForSave;
    }

    public function savePrice($data){
        $data = $this->prepareDataPrice($data);
        foreach ($data as $item){

            $findRow = CryptowatchData::where('provider_id', $item['exchange'])->where('pair_id', $item['currency_pair']);
            if(empty($findRow->get()->toArray())){
                $cryptowatch = new CryptowatchData();
                $cryptowatch->provider_id = $item['exchange'];
                $cryptowatch->pair_id = $item['currency_pair'];
                $cryptowatch->price = $item['price'];
                $cryptowatch->save();
            } else {
                $findRow->update(['price' => $item['price']]);
            };

            try{

            } catch (\Exception $e){
                Log::error($e);
            }
        }
    }

}
