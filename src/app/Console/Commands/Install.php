<?php

namespace Wgnsy\Currency\app\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    use Traits\PrettyCommandOutput;

    protected $progressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:install
                                {--timeout=300} : How many seconds to allow each process to run.
                                {--debug} : Show process output';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Wgnsy/Currency';

    /**
     * Execute the console command.
     *
     * @return mixed Command-line output
     */
    public function handle()
    {
        $this->progressBar = $this->output->createProgressBar(5);
        $this->progressBar->minSecondsBetweenRedraws(0);
        $this->progressBar->maxSecondsBetweenRedraws(120);
        $this->progressBar->setRedrawFrequency(1);

        $this->progressBar->start();

        $this->info(' Install started. Please wait...');
        $this->progressBar->advance();

        $this->line(' Publishing configs, views files');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => 'Wgnsy\Currency\CurrencyServiceProvider'
        ]);

        $this->line(" Creating users table (using Laravel's default migration)");
        $this->executeArtisanProcess('migrate');

        $this->line("Deploy Currency (USD,EUR,CHF) ".config('currency.start_date')." - ".config('currency.end_date')."");
        $this->executeArtisanProcess('db:seed', [
            '--class' => 'Wgnsy\Currency\database\seeders\DatabaseSeeder'
        ]);


        $this->progressBar->finish();
        $this->info(' Install completed.');
    }
}
