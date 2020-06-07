<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CommandFinishedListener
{
    public function handle($event)
    {
        $time = now();
        $timeSinceStart = microtime(true) - LARAVEL_START;
        Log::channel('command')->debug("Finished {$event->command} at {$time} ($timeSinceStart)");
    }
}
