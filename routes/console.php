<?php

use App\Jobs\DeleteExpiredEndpoints;
use App\Models\Endpoint;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


/**
 * Runs the DeleteExpiredEndpoints job every day. This will delete endpoints that have been soft deleted for 5 days.
 */
Schedule::job(new DeleteExpiredEndpoints)->daily();