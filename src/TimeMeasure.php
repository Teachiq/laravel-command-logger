<?php

namespace Teachiq\LaravelCommandLogger;

class TimeMeasure
{
    public function executionTime()
    {
        return microtime(true) - LARAVEL_START;
    }
}
