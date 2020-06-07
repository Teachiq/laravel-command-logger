<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Support\Facades\Storage;

class CommandFinishedListener
{
    public function handle($event)
    {
        $time = now();
        $timeSinceStart = microtime(true) - LARAVEL_START;
        Storage::append('commands.log', "Finished {$event->command} at {$time} ($timeSinceStart)");
    }
}
