# Laravel Scaleway TEM mailer
This package provides a simple way to send emails using the Scaleway TEM service directly from your Laravel application.

## Installation
```
composer require anny/laravel-scaleway-tem
```
This package adds automatically the Scaleway mailer to your mail config. 
First you need to add the credentials for the Scaleway API to your services.php config file.

```php
'scaleway' => [
        'project_id' => env('SCALEWAY_PROJECT_ID'),
        'api_key' => env('SCALEWAY_API_KEY'),
        'region' => env('SCALEWAY_REGION', 'fr-par'),
]
```

After that, extend you mail config with the following code:
```php
'scaleway' => [
    'transport' => 'scaleway',
    ]
```