<?php namespace Laradev\Crypto\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Laradev\Crypto\Models\Currency;
use Laradev\Crypto\Models\Pair;
use Laradev\Crypto\Models\Provider;

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

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $this->output->writeln('Hello world!');

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
