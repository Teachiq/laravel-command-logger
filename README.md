# Log commands with their execution time

[![Latest Version on Packagist](https://img.shields.io/packagist/v/teachiq/laravel-command-logger.svg?style=flat-square)](https://packagist.org/packages/teachiq/laravel-command-logger)

Log the start and finish of all commands, along with their execution time. This is especially useful to detect if scheduled commands (for instance every night) run for longer than expected.

## Installation

You can install the package via composer:

```bash
composer require teachiq/laravel-command-logger
```

## Usage

The package auto-registers. The log is saved by default to `storage/logs/command.log`.

```log
[2020-06-07 10:30:10] local.DEBUG: Starting package:discover at 2020-06-07 10:30:10  
[2020-06-07 10:30:10] local.DEBUG: Finished package:discover at 2020-06-07 10:30:10 (0.19159507751465)  
[2020-06-07 10:30:14] local.DEBUG: Starting route:list at 2020-06-07 10:30:14  
[2020-06-07 10:30:14] local.DEBUG: Finished route:list at 2020-06-07 10:30:14 (0.34346413612366)  
```

### Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email martin.krisell@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
