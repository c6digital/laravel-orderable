# Straightforward ordering for Laravel models.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/c6digital/laravel-orderable.svg?style=flat-square)](https://packagist.org/packages/c6digital/laravel-orderable)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/c6digital/laravel-orderable/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/c6digital/laravel-orderable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/c6digital/laravel-orderable/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/c6digital/laravel-orderable/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/c6digital/laravel-orderable.svg?style=flat-square)](https://packagist.org/packages/c6digital/laravel-orderable)

This package provides a simple `Orderable` trait that you can implement on your Eloquent models. It registers a couple of scopes that allow you to order models and also handles re-ordering models after creation.

## Installation

You can install the package via Composer:

```bash
composer require c6digital/laravel-orderable
```

## Usage

Register the `Orderable` trait on your model.

```php
use C6Digital\Orderable\Concerns\Orderable;
use C6Digital\Orderable\Concerns\OrderableOptions;

class Post extends Model
{
    use Orderable;

    public static function getOrderableOptions(): OrderableOptions
    {
        return OrderableOptions::default()
            ->column('order')               // Set the column that is used to order this model.
            ->reorderOnCreate()             // Determine whether models should be re-ordered after creation.
            ->moveToEndOnCreate()           // Place newly created models at the end.
            ->moveToStartOnCreate()         // Place newly created models at the start.
            ->setOrderUsing(callback: ...); // Set the order manually using a custom callback.
    }
}
```

> The default column is `order`, so make sure you add that to your database table. The package doesn't do it for you automatically.

Use the `ordered()`, `orderedAsc()` and `orderedDesc()` methods to order results in a query.

```php
Post::query()
    ->ordered()     // Defaults to `ASC`.
    ->orderedAsc()  // Orders `ASC`.
    ->orderedDesc() // Orders `DESC`.
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ryan Chandler](https://github.com/c6digital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
