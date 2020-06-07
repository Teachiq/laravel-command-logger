<?php

namespace Teachiq\LaravelCommandLogger\Tests;

use Carbon\Carbon;
use Orchestra\Testbench\TestCase;
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
        Storage::delete('commands.log');
        $this->assertFalse(Storage::exists('commands.log'));

        $this->artisan('route:list');

        $this->assertTrue(Storage::exists('commands.log'));

        $commandLog = Storage::get('commands.log');

        $this->assertStringContainsString('Starting route:list', $commandLog);
        $this->assertStringContainsString('Finished route:list', $commandLog);
    }
}
