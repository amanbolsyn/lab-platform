<?php

use Illuminate\Support\Facades\Schedule;

//delete auth tokens
Schedule::command('sanctum:prune-expired --hours=0')->daily()->at('01:00');

//db backup
Schedule::command('backup:clean')->daily()->at('01:00');
Schedule::command('backup:run --only-db')->everyMinute();

//sending emails
Schedule::command('app:send-order-notify-email')->dailyAt('09:00');