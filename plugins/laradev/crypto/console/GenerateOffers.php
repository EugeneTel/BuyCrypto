<?php namespace Laradev\Crypto\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laradev\Crypto\Models\Offer;
use Laradev\Crypto\Models\OfferStep;
use Laradev\Crypto\Models\PairProvider;
use Laradev\Crypto\Models\Step;
use Laradev\Crypto\Models\Way;

class GenerateOffers extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'crypto:offers';

    /**
     * @var string The console command description.
     */
    protected $description = 'Generate offers';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {


//        $way = Way::
//        with('steps.pair.pairProviders')
//            ->whereId(5)//pair 57
//            ->first();

        $wayList = Way::all();

        $this->output->progressStart(count($wayList));

        foreach ($wayList as $way) {
            $this->output->progressAdvance();
            $this->generateOfferList($way);
        }

        $this->output->progressFinish();
    }


    protected function generateOfferList(Way $way)
    {
//        $this->output->write(' ' . $way->currency_from . ' => ' . $way->currency_to);

        $offerList = $this->prepareProviderList($way);
        $offerList = $this->arrayToOfferArray($offerList);

//        $this->output->writeln(' (Offers: ' . count($offerList) . ')');

        foreach ($offerList as $offer) {

            try {
                DB::beginTransaction();

                $offerStepList = $this->createOfferStepList($way, $offer);
                $this->saveOffer($way, $offer, $offerStepList);

                DB::commit();

            } catch (\Exception $e) {
                Log::error('Generate Offer List Error. (' . $way->currency_from . '=>' . $way->currency_to . ') ' . $e->getMessage());

                DB::rollBack();
            }


        }
    }

    protected function saveOffer(Way $way, $offerArray, $offerStepList)
    {
        $hash = md5(implode('|', $offerArray));

        // check if offer already exist
        $offer = Offer::whereHash($hash)->first();

        if ($offer) {
            return $offer;
        }

        $totalPrice = 0;
        $totalTime = 0;

        $offer = new Offer;
        $offer->way_id = $way->id;
        $offer->hash = $hash;
        $offer->total_price = $totalPrice;
        $offer->total_time = $totalTime;
        $offer->active = true;
        $offer->save();

        $offer->offerSteps()->addMany($offerStepList);

    }

    protected function createOfferStepList(Way $way, $offerArray)
    {

        $result = [];

        $pairProviderList = PairProvider::whereIn('id', $offerArray)->get();

        foreach ($pairProviderList as $pairProvider) {
            $step = Step::whereWayId($way->id)->wherePairId($pairProvider->pair_id)->firstOrFail();

            $result[] = new OfferStep([
                'step_id' => $step->id,
                'provider_id' => $pairProvider->provider_id,
                'pair_provider_id' => $pairProvider->id,
                'price' => $pairProvider->price,
                'time_avg' => $pairProvider->time_avg,
                'order' => $step->order,

            ]);
        }

        // check that is all fine
        if (count($result) != count($offerArray)) {
            throw new \Exception('Create Offer Step List Error. Mismatch counts of entities');
        }

        return $result;
    }

    protected function arrayToOfferArray($array)
    {
        // convert hierarchy array to string
        $str = $this->arrayToPipe($array);
        unset($array);

        // convert string to separate ways array
        $offerList = explode(PHP_EOL, $str);
//        unset($str);

        $fullList = [];
        foreach ($offerList as $offer) {

            $offer = substr($offer, 0, -1);
            $fullList[] = explode('|', $offer);
        }

        return $fullList;
    }


    protected function prepareProviderList($way, $nextStep = 0)
    {
        $result = [];
        $step = $way->steps->get($nextStep);

        $nextStep++;

        foreach ($step->pair->pairProviders as $provider) {

            if ($way->steps->count() > $nextStep) {
                $result[$provider->id] = $this->prepareProviderList($way, $nextStep);
            } else {
                $result[$provider->id] = false;
            }

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
}
