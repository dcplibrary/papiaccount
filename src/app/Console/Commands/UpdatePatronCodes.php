<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\Services\PAPIPatronCodeFetcher; // Import the new service class

    class UpdatePatronCodes extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'papi:fetch-patroncodes';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Fetches data from an external API and populates the database.';

        /**
         * The ApiDataFetcher service instance.
         *
         * @var \App\Services\PAPIPatronCodeFetcher
         */
        protected $papiDataFetcher;

        /**
         * Create a new command instance.
         *
         * The service is injected automatically by Laravel's service container.
         *
         * @param \App\Services\PAPIPatronCodeFetcher $papiDataFetcher
         * @return void
         */
        public function __construct(PAPIPatronCodeFetcher $papiDataFetcher)
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

 /*           try {*/
                // Call the service to perform the core logic.
                $this->papiDataFetcher->fetchAndPopulate('patroncodes');

                $this->info("Successfully imported Patron Codes from Polaris.");

                return Command::SUCCESS;
/*
            } catch (\Exception $e) {
                $this->error('An error occurred during the operation:');
                $this->error($e->getMessage());
                return Command::FAILURE;
            }*/
        }
    }
