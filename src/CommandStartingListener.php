<?php

namespace Teachiq\LaravelCommandLogger;

use Illuminate\Support\Facades\Storage;

class CommandStartingListener
{
    public function handle($event)
    {
        $time = now();
        Storage::append('commands.log', "Starting {$event->command} at {$time}");
    }
}
