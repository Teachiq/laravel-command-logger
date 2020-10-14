<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider 
{
    protected $listen = [
        CommandStarting::class => [CommandStartingListener::class],
        CommandFinished::class => [CommandFinishedListener::class],
    ];
}
