<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote');
//
//Schedule::call(function () {
//    \Illuminate\Support\Facades\Log::info('This is a scheduled task');
//})->everyTenSeconds();

Schedule::job(new \App\Jobs\UserCheckIdentityValidity())->everyMinute();

