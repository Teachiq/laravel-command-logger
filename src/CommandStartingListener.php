<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CommandStartingListener
{
    public function handle($event)
    {
        config(['logging.channels.command' => config('command-log.channel')]);

        $time = now();
        Log::channel('command')->debug("Starting {$event->command} at {$time}");
    }
}
