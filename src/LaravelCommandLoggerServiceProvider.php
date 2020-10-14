<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Support\Facades\Event;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Teachiq\LaravelCommandLogger\LaravelCommandLoggerServiceProvider;

class LaravelCommandLoggerServiceProvider extends EventServiceProvider
{
    public function register()
    {
        $this->app->register(\Teachiq\LaravelCommandLogger\EventServiceProvider::class);

        $this->mergeConfigFrom(__DIR__.'/config/command-log.php', 'command-log');
    }
}
