<p align="center">
    <a href="https://packagist.org/packages/queenshera/admin-panel">
        <img src="https://img.shields.io/packagist/v/queenshera/admin-panel" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/queenshera/admin-panel">
        <img src="https://img.shields.io/packagist/l/queenshera/admin-panel" alt="License">
    </a>
</p>

# Laravel Admin-Panel
Read up here for getting started and understanding the setup of admin panel

### Prerequisites
- Minimum PHP version ^8.0


## Installation
- Ensure you have enabled sodium extension in your php.ini file, otherwise it will generate error while installing adminPanel
- If your project using composer, run the below command

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

- The environment and config files comes with defaults and placeholders.
- Configure environment key-values in environment file to use aws s3, textlocal, msg91, razorpay services.
- 

## Available Services in this package
- [Debugbar](https://github.com/barryvdh/laravel-debugbar/blob/master/readme.md)
- [DomPDF](https://github.com/barryvdh/laravel-dompdf/blob/master/readme.md)
- [Livewire](https://laravel-livewire.com/docs/quickstart)
- [AWS S3](https://github.com/queenshera/laravel-admin-panel/blob/dev/FileUpload.md)
- Firebase (not tested yet)
- [PestPHP](https://pestphp.com/docs/)
- [Textlocal](https://github.com/queenshera/laravel-admin-panel/blob/dev/TextLocal.md) SMS service
- [MSG91](https://github.com/queenshera/laravel-admin-panel/blob/dev/MSG91.md) SMS service
- [Razorpay](https://github.com/queenshera/laravel-admin-panel/blob/dev/Razorpay.md) payment gateway service
- 

## Development

- All added packages are not tested yet and under developments.
- All pull requests with additional packages or test cases are welcome.

## License

Queenshera Admin Panel SDK is released under the MIT License. See [LICENSE](https://github.com/queenshera/laravel-admin-panel/blob/dev/LICENCE) file for more details.
