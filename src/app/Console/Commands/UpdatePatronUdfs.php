<?php

namespace Dcplibrary\PAPIAccount\App\Console\Commands;

use Dcplibrary\PAPIAccount\App\Services\PAPIPatronUdfsService;
use Illuminate\Console\Command;

class UpdatePatronUdfs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'papi:fetch-patronudfs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches data from an external API and populates the database.';

    /**
     * The PAPIPatronUdfsDataFetcher service instance.
     *
     * @var PAPIPatronUdfsService
     */
    protected $papiDataFetcher;

    /**
     * Create a new command instance.
     *
     * The service is injected automatically by Laravel's service container.
     *
     * @param PAPIPatronUdfsService $papiDataFetcher
     *
     * @return void
     */
    public function __construct(PAPIPatronUdfsService $papiDataFetcher)
    {
        parent::__construct();
        $this->papiDataFetcher = $papiDataFetcher;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting data fetch from external API...');

        try {
            $this->papiDataFetcher->fetchAndPopulate();

            $this->info('Successfully imported Patron Codes from Polaris.');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('An error occurred during the operation:');
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
