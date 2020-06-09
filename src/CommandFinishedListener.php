<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CommandFinishedListener
{
    public function handle($event)
    {
        if (in_array($event->command, config('command-log.exclude'))) {
            return;
        }

        // This is set here again since some commands may cache or clear the config
        config(['logging.channels.command' => config('command-log.channel')]);

        $time = now();
        $timeSinceStart = microtime(true) - LARAVEL_START;

        $prefix = ($timeSinceStart > config('command-log.slow')) ? '__SLOW__ ' : '';
        Log::channel('command')->debug("{$prefix}Finished {$event->command} at {$time} ($timeSinceStart seconds)");
    }
}
