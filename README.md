# PAPIAccount

[![CI](https://github.com/dcplibrary/papiaccount/actions/workflows/ci.yml/badge.svg)](https://github.com/dcplibrary/papiaccount/actions/workflows/ci.yml)
[![Code Quality](https://github.com/dcplibrary/papiaccount/actions/workflows/code-quality.yml/badge.svg)](https://github.com/dcplibrary/papiaccount/actions/workflows/code-quality.yml)
[![Latest Stable Version](https://poser.pugx.org/dcplibrary/papiaccount/v/stable)](https://packagist.org/packages/dcplibrary/papiaccount)
[![License](https://poser.pugx.org/dcplibrary/papiaccount/license)](https://packagist.org/packages/dcplibrary/papiaccount)

A Laravel package for PAPIAccount functionality.

## Installation

You can install the package via composer:

```bash
composer require dcplibrary/papiaccount
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag="papiaccount-config"
```

This will publish the configuration file to `config/papiaccount.php`.

## Usage

### Basic Usage

```php
use Dcplibrary\PAPIAccount\PAPIAccount;

$instance = new PAPIAccount();
echo $instance->name(); // PAPIAccount
echo $instance->version(); // 1.0.0
```

### Using the Facade

```php
use Dcplibrary\PAPIAccount\Facades\PAPIAccount;

PAPIAccount::name(); // PAPIAccount
PAPIAccount::version(); // 1.0.0
```

### Service Provider Registration

The service provider is automatically registered. The package provides:

- Routes at `/papiaccount`
- Views under the `papiaccount` namespace
- Configuration merging
- Database migrations

## Testing

Run the tests with:

```bash
composer test
```

## Code Quality

Run code formatting:

```bash
composer format
```

Run static analysis:

```bash
composer analyse
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email blashbrook@dcplibrary.org instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [Brian Lashbrook](https://github.com/blashbrook)
- [All Contributors](../../contributors)

## About DC Public Library

This package is developed and maintained by the DC Public Library development team.
