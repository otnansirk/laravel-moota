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
Register user

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
Generate access token

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
Destroy access token

Method : `MootaAuth::logout()`<br>
 - **Required** : -
 - **Optional** : -
```
<?php

  MootaAuth::logout();
```

### Profile
Get user profile

Method : `MootaAuth::profile()`<br>
 - **Required** : -
 - **Optional** : -
```
<?php

  MootaAuth::profile();
```

## Bank Accounts

### Available Bank
Get list available of bank Integration

Method : `MootaBank::available($page, $limit)` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : $page, $limit
 - **Default**  :
    - $page = 1
    - $limit = 10
```
<?php

  MootaBank::available(1, 10);
```

### List Of Bank
Get list of your bank accounts that you have registered at moota.

Method : `MootaBank::list($page, $limit)` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : $page, $limit
 - **Default**  :
    - $page = 1
    - $limit = 10
```
<?php

  MootaBank::list(1, 10);
```

### Create Bank
Stor bank account

Method : `MootaBank::store($data)` <br/>
Params : <br>
  - **Required** : $data
  - **Optional** : -
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
Update bank account

Method : `MootaBank::update($data, $id)` <br/>
Params : <br>
  - **Required** : $data, $id
  - **Optional** : -
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
Destroy bank account

Method : `MootaBank::destroy($id)` <br/>
Params : <br>
  - **Required** : $id
  - **Optional** : -
```
<?php

  $id = "123";
  MootaBank::update($id);
```

### E-Wallet Request OTP
This is for activating your Gojek and Ovo E-wallet accounts,
after you make a call request this endpoint, there will be an OTP that you will receive via your mobile number,
and make a call MootaBank::verifyOtp() after getting OTP Code

Method : `MootaBank::requestOtp($id)` <br/>
Params : <br>
  - **Required** : $id
  - **Optional** : -
```
<?php

  $id = "123";
  MootaBank::requestOtp($id);
```

### E-Wallet Verify OTP
This is for activating your Gojek and Ovo E-wallet accounts.
after you get the OTP code, verify the code through this endpoint

Method : `MootaBank::verifyOtp($otpCode, $id)` <br/>
Params : <br>
  - **Required** : $otpCode, $id
  - **Optional** : -
```
<?php

  $id = "123";
  MootaBank::verifyOtp("1234", $id);
```


## Mutations
### Refresh mutation
This is for getting the latest updates before the bank interval runs.

Method : `MootaMutation::refresh()` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : -
```
<?php

  MootaMutation::refresh("1234", $id);
```
### List mutation
Get list of mutations

Method : `MootaMutation::list($params)` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : $params
```
<?php

  $params = [
      "type"       => "credit",
      "bank_id"    => "1234",
      "start_date" => "1997-01-10",
      "end_date"   => "1997-01-10",
      "tag"        => "muta",
      "page"       => 1,
      "par_page"   => 10
  ];

  MootaMutation::list($params);
```
### Store mutation
Create dummy mutation

Method : `MootaMutation::store($data, $bankId)` <br/>
Params : <br>
  - **Optional** : -
  - **Required** : $data, $bankId
```
<?php

  $data = [
      "date"   => "1997-01-10",
      "note"   => "muta",
      "amount" => 1,
      "type"   => 10
  ];

  MootaMutation::store($data, "123");
```
### Note mutation
Update note of mutation

Method : `MootaMutation::note($nota, $mutationId)` <br/>
Params : <br>
  - **Required** : $nota, $mutationId
  - **Optional** : -
```
<?php

  $note = "Note 1";
  MootaMutation::note($data, "123");
```
### Delete mutation
Delete mutation can be multiple

Method : `MootaMutation::destroy($mutationIds)` <br/>
Params : <br>
  - **Required** : $mutationIds
  - **Optional** : -
```
<?php

  MootaMutation::destroy("mutation_id");
```
You can destroy multiple mutation like this
```
<?php

  $mutationIds = ["mutation_id", "mutation_id"];
  MootaMutation::destroy($mutationIds);
```
### Tags mutation
Add tags to mutation

Method : `MootaMutation::tags($tags, $mutationId)` <br/>
Params : <br>
  - **Required** : $tags, $mutationId
  - **Optional** : -
```
<?php

  MootaMutation::tags("tags_q", "123");
```
You can add tags multiple to mutation like this
```
<?php

  $tags = ["tags_1", "tags_2"];
  MootaMutation::MootaMutation($tags, $mutationId);
```
### Summary mutation
To get a summary of mutations in your account

Method : `MootaMutation::summary($params)` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : $params
```
<?php

  $params = [
    "bank_id"    => "123",
    "type"       => "credit",
    "start_date" => "1997-10-10",
    "end_date"   => "1997-10-10",
  ];

  MootaMutation::summary($params);
```
### Webhook test
This for testing push data to webhook

Method : `MootaMutation::webhook($mutationId)` <br/>
Params : <br>
  - **Required** : $mutationId
  - **Optional** : -
```
<?php

  MootaMutation::webhook("1234");
```

### Taggings
### Store
Store tagging

Method : `MootaTag::store($name)` <br/>
Params : <br>
  - **Required** : $name
  - **Optional** : -
```
<?php

  MootaTag::store("Bayar Token");
```
### Update
Update tagging

Method : `MootaTag::update($name, $id)` <br/>
Params : <br>
  - **Required** : $name, $id
  - **Optional** : -
```
<?php

  MootaTag::update("Bayar Pulsa", "1234");
```

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
