<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class LaravelCommandLoggerServiceProvider extends EventServiceProvider
{
    protected $listen = [
        CommandStarting::class => [CommandStartingListener::class],
        CommandFinished::class => [CommandFinishedListener::class],
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/command-log.php', 'command-log');
    }
}
