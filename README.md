# Laravel Moota
Laravel Moota is a mutation grapher built using laravel with moota.id api. This allows you to immediately focus on business flow without the hassle of making manual requests to the moota.id server.

# Installation

#### 1. You can install the package via composer.
```
composer require otnansirk/laravel-moota
```
#### 2. Optional : The service provider will automatically get registered. Or you my manually add the service provider in your `configs/app.php` file.
```
'providers' => [
    // ...
    Otnansirk\Moota\MootaCoreServiceProvider::class,
];
```
#### 3. You should publish the `config/moota.php` config file with this php artisan command.
```
php artisan vendor:publish --provider="Otnansirk\Moota\MootaCoreServiceProvider"
```

# How to Use
All config store to `/configs/moota.php`. Customize evrything you need.

## Functions

### Register User | `MootaAuth::register($data)`
```
<?php

    $data = [
        "name" => "moota",
        "email" => "moota@email.co",
        "password" => "your password",
        "password_confirmation" => "your password confirmation"
    ];

    MootaAuth::register($data);
```

### Login(Get Token) | `MootaAuth::login($email, $password, $scopes)`
```
<?php

    MootaAuth::login('moota_email', 'moota_password', ["api"]);
```

Scopes = `api` for all access to api v2.

### Logout(Destroy Token) | `MootaAuth::logout()`
```
<?php

    MootaAuth::logout();
```

### Profile | `MootaAuth::profile()`
```
<?php

    MootaAuth::profile();
```

Scopes = `api` for all access to api v2.

### Bank Accounts
 Upcoming

### Mutations
 Upcoming

### Taggings
 Upcoming

### Mootapay
 Upcoming

### Topups
 Upcoming

### Webhooks
 Upcoming

### Merchant
 Upcoming


# Contribution
This project is far from perfect. many Moota APIs that have not been implemented. I would be very happy if any of you could contribute for this project.

Fork this project and make merge request. :)
