<?php

namespace Teachiq\LaravelCommandLogger\Tests;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Teachiq\LaravelCommandLogger\EmailLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Teachiq\LaravelCommandLogger\Tests\TestMailable;
use Teachiq\LaravelCommandLogger\LaravelCommandLoggerServiceProvider;

define('LARAVEL_START', microtime(true));

class CommandLoggerTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [LaravelCommandLoggerServiceProvider::class];
    }

    /** @test */
    public function commands_executed_are_logged()
    {
        Log::swap(new \TiMacDonald\Log\LogFake);

        $this->artisan('route:list');

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Starting route:list');
        });

        $this->artisan('help');

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Starting help');
        });
    }
}
