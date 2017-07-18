<?php namespace Laradev\Crypto\Console;

use Illuminate\Console\Command;
use Laradev\Crypto\Models\Offer;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CalculateOffers extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'crypto:calculateoffers';

    /**
     * @var string The console command description.
     */
    protected $description = 'Calculate generated offers';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {

        $count = Offer::active()->count();
        $this->output->progressStart($count);


        Offer::with('offerSteps')->active()->chunk(100, function($offerList) {

            foreach ($offerList as $offer) {
                $this->output->progressAdvance();

                $this->calculateOffer($offer);
            }
        });

        $this->output->progressFinish();


    }

    protected function calculateOffer(Offer $offer)
    {
        $offerStepList = $offer->offerSteps->sortBy('order');

        $totalPrice = 0;
        $totalTime = 0;

        foreach ($offerStepList as $offerStep) {
            if ($totalPrice == 0) {
                $totalPrice = $offerStep->price;
            } else {
                $totalPrice *= $offerStep->price;
            }

            $totalTime += intval($offerStep->time_avg);
        }

        $offer->total_price = $totalPrice;
        $offer->total_time = $totalTime;
        $offer->save();
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
