<p align="center">
  <a href="https://packagist.org/packages/otnansirk/laravel-moota">
    <img alt="Laravel Moota" src="https://raw.githubusercontent.com/otnansirk/laravel-moota/master/assets/logo.png" width="500" />
  </a>
</p>
<h1 align="center">
  Laravel Moota
</h1>

<p align="center">
  <a href="https://github.com/otnansirk/laravel-moota/blob/master/LICENSE">
    <img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="Laravel Moota is released under the MIT license." />
  </a>
</p>


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

## Auth

### Register User
Method : `MootaAuth::register($data)` <br>
Params :
 - **Required** : $data
 - **Optional** : -
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

### Login(Get Token)
Method : `MootaAuth::login($email, $password, $scopes)`<br>
Params :
 - **Required** : $email, $password
 - **Optional** : $scopes
 - **Default**  :
    - $scopes = ["api"]
```
<?php

  MootaAuth::login('moota_email', 'moota_password', ["api"]);
```

Scopes = `api` for all access to api v2.

### Logout(Destroy Token)
Method : `MootaAuth::logout()`<br>
 - **Required** : -
 - **Optional** : -
```
<?php

  MootaAuth::logout();
```

### Profile
Method : `MootaAuth::profile()`<br>
 - **Required** : -
 - **Optional** : -
```
<?php

  MootaAuth::profile();
```

## Bank Accounts

### List Of Available Bank Integration
Method : `MootaBank::available($page, $limit)` <br/>
Params : <br>
  - **Optional** : $page, $limit
  - **Required** : -
 - **Default**  :
    - $page = 1
    - $limit = 10
```
<?php

  MootaBank::available(1, 10);
```

### List Of Bank
Method : `MootaBank::list($page, $limit)` <br/>
Params : <br>
  - **Optional** : $page, $limit
  - **Required** : -
 - **Default**  :
    - $page = 1
    - $limit = 10
```
<?php

  MootaBank::list(1, 10);
```

### Create Bank
Method : `MootaBank::store($data)` <br/>
Params : <br>
  - **Optional** : $data
  - **Required** : -
```
<?php

  $data = [
    "corporate_id" => "",
    "bank_type"    => "bca",
    "username"     => "user_ibanking",
    "password"     => "password_ibanking",
    "name_holder"  => "Jhone Dhoe",
    "is_active"    => true,
    "account_number"=> 16899030
  ];

  MootaBank::store($data);
```

### Update Bank
Method : `MootaBank::update($data, $id)` <br/>
Params : <br>
  - **Optional** : $data, $id
  - **Required** : -
```
<?php

  $id = "123";
  $data = [
    "corporate_id" => "",
    "bank_type"    => "bca",
    "username"     => "user_ibanking",
    "password"     => "password_ibanking",
    "name_holder"  => "Jhone Dhoe",
    "is_active"    => true,
    "account_number"=> 16899030
  ];

  MootaBank::update($data, $id);
```

### Delete Bank
Method : `MootaBank::destroy($id)` <br/>
Params : <br>
  - **Optional** : $id
  - **Required** : -
```
<?php

  $id = "123";
  MootaBank::update($id);
```

### E-Wallet Request OTP
Method : `MootaBank::requestOtp($id)` <br/>
Params : <br>
  - **Optional** : $id
  - **Required** : -
```
<?php

  $id = "123";
  MootaBank::requestOtp($id);
```

### E-Wallet Verify OTP
Method : `MootaBank::verifyOtp($otpCode, $id)` <br/>
Params : <br>
  - **Optional** : $otpCode, $id
  - **Required** : -
```
<?php

  $id = "123";
  MootaBank::verifyOtp("1234", $id);
```


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
