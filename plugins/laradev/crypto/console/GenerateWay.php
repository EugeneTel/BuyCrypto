<?php namespace Laradev\Crypto\Console;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laradev\Crypto\Models\Currency;
use Laradev\Crypto\Models\Pair;
use Laradev\Crypto\Models\Provider;
use Laradev\Crypto\Models\Way;

class GenerateWay extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'crypto:generateway';

    /**
     * @var string The console command description.
     */
    protected $description = 'Generate ways';

    protected $stepLimit = 5;
    protected $currentStep = 0;
    protected $currencyFrom;
    protected $currencyTo;
    protected $wayList;

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $this->output->writeln('Hello world!');


        $curFromList = Currency::whereActive(true)
            ->whereType(Currency::TYPE_FIAT)
//            ->whereName('WMZ')
            ->get();

        $curToList = Currency::whereActive(true)
            ->whereType(Currency::TYPE_CRYPTO)
//            ->whereName('Bitcoin')
            ->get();

        foreach ($curFromList as $curFrom) {

            foreach ($curToList as $curTo) {

                try {
                    $wayList = $this->generateWayList($curFrom, $curTo);

                    // create ways
                    foreach ($wayList as $way) {

                        try {
                            Db::beginTransaction();

                            $this->createWay($way, $curFrom, $curTo);

                            Db::commit();

                        } catch (\Exception $e) {
                            Log::error('Create way error. (' . $curFrom->name . '=>' . $curTo->name . ') ' . $e->getMessage());

                            Db::rollBack();
                        }

                    }

                    $this->output->writeln($curFrom->name . ' => ' . $curTo->name . ' | Ways count: ' . count($wayList));

                } catch (\Exception $e) {
                    Log::error('Generate way error. (' . $curFrom->name . '=>' . $curTo->name . ') ' . $e->getMessage());
                }

            }

        }

    }



    protected function createWay(array $stepList, Currency $curFrom, Currency $curTo)
    {
        $hash = md5(implode('|', $stepList));

        // check if a way already exist
        $way = Way::whereHash($hash)->first();

        if ($way) {
            return $way;
        }

        // create new way
        $way = new Way;
        $way->hash = $hash;
        $way->currency_from = $curFrom->id;
        $way->currency_to = $curTo->id;
        $way->save();

        // add steps for way
        $stepOrder = 0;
        foreach ($stepList as $pairName) {
            $pair = Pair::whereName($pairName)->firstOrFail();

            $way->steps()->create([
                'pair_id' => $pair->id,
                'order' => $stepOrder,
            ]);
            $stepOrder++;
        }

        return $way;
    }

    protected function generateWayList(Currency $currencyFrom, Currency $currencyTo)
    {
        $this->currencyFrom = $currencyFrom;
        $this->currencyTo = $currencyTo;

        $hierarchyList = $this->checkCurrency($currencyFrom);

        if (! is_array($hierarchyList) || count($hierarchyList) <= 0) {
            return [];
        }

        // convert hierarchy array to string
        $str = $this->arrayToPipe($hierarchyList);
        unset($hierarchyList);

        // convert string to separate ways array
        $wayList = explode(PHP_EOL, $str);
        unset($str);

        $fullList = [];
        foreach ($wayList as $way) {

            $way = substr($way, 0, -2);
            $fullList[] = explode('|', $way);
        }
        unset($wayList);

        return $fullList;
    }



    public function checkCurrency(Currency $currency, $step = 0, $usedPairList = [])
    {
        if ($step > $this->stepLimit) {
            return false;
        }

        /** @var Collection $pairList */
        $pairList = Pair::where('currency_from', $currency->id)->get();

        if ($pairList->count() <= 0) {
            return false;
        }

        $result = [];

        $newStep = $step + 1;

        foreach ($pairList as $pair) {

            // remove used pairs
            if (isset($usedPairList[$pair->id]) || $pair->currency_to == $this->currencyFrom->id) {
                continue;
            }

            $curTo = Currency::whereId($pair->currency_to)->first();

            if ($curTo->id == $this->currencyTo->id) {
                $result[$pair->name] = true;

            } else {
                $usedPairList[$pair->id] = true;
                $newPair = $this->checkCurrency($curTo, $newStep, $usedPairList);

                if ($newPair) {
                    $result[$pair->name] = $newPair;
                }
            }
        }

        if (!$result) {
            return false;
        }

        return $result;
    }

    protected function arrayToPipe($array, $delimeter = '|', $parents = [], $recursive = false)
    {
        $result = '';

        if (!is_array($array)) {
            return false;
        }

        foreach ($array as $key => $value) {
            $group = $parents;
            array_push($group, $key);

            // check if value is an array
            if (is_array($value)) {
                if ($merge = $this->arrayToPipe($value, $delimeter, $group, true)) {
                    $result = $result . $merge;
                }
                continue;
            }

            // check if parent is defined
            if (!empty($parents)) {
                $result = $result . PHP_EOL . implode($delimeter, $group) . $delimeter . $value;
                continue;
            }

            $result = $result . PHP_EOL . $key . $delimeter . $value;
        }

        // somehow the function outputs a new line at the beginning, we fix that
        // by removing the first new line character
        if (!$recursive) {
            $result = substr($result, 1);
        }

        return $result;
    }


    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
