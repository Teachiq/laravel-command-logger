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
use Teachiq\LaravelCommandLogger\TimeMeasure;
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
            return Str::contains($message, 'Starting route:list at');
        });

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Finished route:list at');
        });

        $this->artisan('help');

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Starting help at');
        });

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Finished help at');
        });
    }

    /** @test */
    public function excluded_commands_are_not_logged()
    {
        Log::swap(new \TiMacDonald\Log\LogFake);

        $this->artisan('route:list');

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Starting route:list at');
        });

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Finished route:list at');
        });

        config(['command-log.exclude' => ['help']]);

        $this->artisan('help');

        Log::channel('command')->assertNotLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Starting help at');
        });

        Log::channel('command')->assertNotLogged('debug', function ($message, $context) {
            return Str::contains($message, 'Finished help at');
        });
    }

    /** @test */
    public function slow_executions_are_marked()
    {
        Log::swap(new \TiMacDonald\Log\LogFake);

        $this->artisan('route:list');

        Log::channel('command')->assertNotLogged('debug', function ($message, $context) {
            return Str::contains($message, '__SLOW__');
        });

        $this->mock(TimeMeasure::class, function ($mock) {
            $mock->shouldReceive('executionTime')->once()->andReturn(10);
        });

        $this->artisan('route:list');

        Log::channel('command')->assertLogged('debug', function ($message, $context) {
            return Str::contains($message, '__SLOW__');
        });
    }
}
