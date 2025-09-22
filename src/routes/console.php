<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('papi:fetch-patroncodes')->daily();
Schedule::command('papi:fetch-patronudfs');
