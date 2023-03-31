# Laravel Admin-Panel
Read up here for getting started and understanding the setup of admin panel

### Prerequisites
- Minimum PHP version ^8.0


## Installation

-   If your project using composer, run the below command

```
composer require queenshera/admin-panel
```

- Add the `Queenshera\AdminPanel\QsAdminPanelServiceProvider::class,` provider to the `providers` array in `config/app.php`:

```php
'providers' => [
  Queenshera\AdminPanel\QsAdminPanelServiceProvider::class,
],
```

- Install all configuration and resource data files with command `php artisan adminPanel:install`. 

## Configuration

The environment and config files comes with defaults and placeholders. Configure data in environment file to use any related services.

## Available Services in this package
- Debugbar (tested)
- DomPDF (tested)
- PestPHP (tested)
- AWS S3
- Livewire
- Firebase
- Textlocal SMS service (tested)
- MSG91 SMS service (tested)
- Razorpay payment gateway (tested)
- 

## Development

- All added packages are not tested yet and under developments
All pull requests with additional packages or test cases are welcome

## License

Queenshera Admin Panel SDK is released under the MIT License. See [LICENSE](https://github.com/queenshera/laravel-admin-panel/blob/dev/LICENCE) file for more details.
