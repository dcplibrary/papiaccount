<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\Models\PendingUpdate;
    use Carbon\Carbon;

    class DeleteExpiredPendingUpdates extends Command
    {
        /**
         * The name and signature of the console command.
         */
        protected $signature = 'pendingupdates:delete-expired';

        /**
         * The console command description.
         */
        protected $description = 'Delete pending updates that are older than 24 hours';

        /**
         * Execute the console command.
         */
        public function handle()
        {
            $expiredUpdates = PendingUpdate::where('created_at', '<', Carbon::now()->subHours(24))->get();

            $count = $expiredUpdates->count();

            foreach ($expiredUpdates as $update) {
                $update->delete();
            }

            $this->info("Deleted {$count} expired pending updates.");
        }
    }
