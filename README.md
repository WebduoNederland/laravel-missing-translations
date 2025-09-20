# Laravel missing translations

This package detects missing Laravel translations and stores them in a database table. This makes it easy to track and add missing entries to your translation files.

## Requirements
- Laravel 12 or higher
- PHP 8.3 or higher

## Installation

You can install the package via composer:

```bash
composer require webduonederland/laravel-missing-translations
```

Run the migrations with:

```bash
php artisan migrate
```

## Usage

The package monitors for missing translations whenever a Laravel translation function, such as:

```php
__('Hello world')
```

or

```php
@lang('Hello world!')
```

doesn’t find a matching entry. When this happens, the package saves the string in the ``missing_translations`` database table.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.