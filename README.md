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


# Documentation
- [Documentation](#documentation)
- [Installation](#installation)
- [How to Use](#how-to-use)
  * [Auth](#auth)
    + [Register User](#register-user)
    + [Login(Get Token)](#login-get-token-)
    + [Logout(Destroy Token)](#logout-destroy-token-)
    + [Profile](#profile)
  * [Bank Accounts](#bank-accounts)
    + [Available Bank](#available-bank)
    + [List Of Bank](#list-of-bank)
    + [Create Bank](#create-bank)
    + [Update Bank](#update-bank)
    + [Delete Bank](#delete-bank)
    + [E-Wallet Request OTP](#e-wallet-request-otp)
    + [E-Wallet Verify OTP](#e-wallet-verify-otp)
  * [Mutations](#mutations)
    + [Refresh mutation](#refresh-mutation)
    + [List mutation](#list-mutation)
    + [Store mutation](#store-mutation)
    + [Note mutation](#note-mutation)
    + [Delete mutation](#delete-mutation)
    + [Tags mutation](#tags-mutation)
    + [Summary mutation](#summary-mutation)
    + [Webhook test](#webhook-test)
  * [Taggings](#taggings)
    + [Store](#store)
    + [Update](#update)
  * [Mootapay](#mootapay)
    + [Contract](#contract)
    + [Transaction List](#transaction-list)
    + [Payment Method](#payment-method)
    + [Cancelled Transaction](#cancelled-transaction)
    + [Plugin Token](#plugin-token)
    + [Moota Callback](#moota-callback)
  * [Topups](#topups)
    + [Topup to](#topup-to)
    + [Topup](#topup)
    + [History](#history)
    + [Point](#point)
    + [Point used](#point-used)
    + [Redeem code](#redeem-code)
  * [Webhooks](#webhooks)
    + [List](#list)
    + [Store](#store-1)
    + [Destroy](#destroy)
  * [Merchant](#merchant)
    + [List](#list-1)
    + [Store](#store-2)
    + [Store Legal](#store-legal)
    + [Update](#update-1)
    + [Update Legal](#update-legal)
- [Contribution](#contribution)



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

## Taggings
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

## Mootapay

### Contract
Create contract

Method : `MootaPay::contract($data)->save()` <br/>
Params : <br>
  - **Required** : $data
  - **Optional** : -
 ```
 <?php

  $data = [
    "invoice_number" => "inv-fattah-17"
    "amount" => 20000
    "payment_method_id" => "4D0LWdYkevQ"
    "type" => "payment"
    "callback_url" => "https://app.moota.co/debug/webhook"
    "expired_date" => "2022-08-02 20:00:00"
    "description" => "penjualan baju polos"
    "increase_total_from_unique_code" => 1
    "customer" => [
      "name" => "Terry Herman"
      "email" => "jedidiah35@example.com"
      "phone" => "622513121190"
    ]
    "items" => [
      0 => array:5 [
        "name" => "t-shirt white"
        "qty" => 10
        "price" => 10000
        "sku" => "SKU-245-8411"
        "image_url" => "https://via.placeholder.com/150"
      ]
      1 => array:5 [
        "name" => "t-shirt white"
        "qty" => 10
        "price" => 10000
        "sku" => "SKU-188-0680"
        "image_url" => "https://via.placeholder.com/150"
      ]
    ]
    "with_unique_code" => 1
    "start_unique_code" => 10
    "end_unique_code" => 20
    "unique_code" => 0
  ];

  MootaPay::contract($data)->save();
 ```

### Transaction List
List of payment transaction

Method : `MootaPay::list()` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : -
 ```
 <?php

  MootaPay::list();

  OR

  MootaPay::contract()->list();

 ```

### Payment Method
Available payment method

Method : `MootaPay::method()` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : -
 ```
 <?php

  MootaPay::method();

 ```
### Cancelled Transaction
Can cancel transaction with this method

Method : `MootaPay::canceled($trxId)` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : -
 ```
 <?php

  MootaPay::canceled("TRX-1234");

 ```
### Plugin Token

Method : `MootaPay::pluginToken()` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : -
 ```
 <?php

  MootaPay::pluginToken()

 ```

 ### Moota Callback
You will receive this data from the webhook url that you have registered <br>
If you leave data blank, this method will generate your callback data from faker api.

Method : `MootaPay::callback($data)` <br/>
Params : <br>
  - **Required** : -
  - **Optional** : $data
 ```
 <?php

  $data = [
    "total" => "102351",
    "amount" => "69015",
    "status" => "success",
    "trx_id" => "trx-c91b6dd3-1bbc-5c3e-bf26-84d925a03a43",
    "created_at" => "2022-02-04 15:08:23",
    "invoice_number" => "INV-923-737-2218",
    "payment_at" => "2022-02-04 20:08:23",
    "unique_code" => "0",
    "expired_date" => "2022-02-05 15:08:23",
    "payment_method_id" => "pn3ykVZkNRD"
  ];

  MootaPay::callback($data)

 ```

## Topups

  ### Topup to
  List bank for transfer to topup point

  ```
  MootaTopup::topup()->to();
  ```
  ### Topup
  Topup point to moota
  ```
  $data = [
    'amount' => 50000,
    'payment_method' => 'bcaGiro' // This value is bank_type from response MootaTopup::topup()->to()
  ];

  MootaTopup::topup($data)->save();
  ```
  ### History
  History of topup
  ```
  MootaTopup::history();
  ```

  ### Point
  List of available point
  ```
  MootaTopup::point()->get()
  ```

  ### Point used
  View the history of the point has been used
  ```
    MootaTopup::point()->used();
  ```
  Or you can filter like this
  ```
  $filter = [
    "start_date" => 'date_format:Y-m-d',
    'end_date'   => 'date_format:Y-m-d',
    'page'       => 1,
    'per_page'   => 10
  ];

  MootaTopup::point()->used($filters);
  ```
  ### Redeem code
  ```
  MootaTopup::redeem('1234');
  ```

## Webhooks
  ### List
  Get list of webhook
  ```
  MootaWebhook::list();
  ```
  Or you can use filter like this
  ```
  $filter = [
    'url' => 'your_url'
  ];

  MootaWebhook::list($filter);
  ```
  ### Store
  Create/store list of webhook
  ```
  $data = [
    "url"               => "https =>//app.moota.co/endpoint/webhooks",
    "bank_account_id"   => "hq10916...",
    "kinds"             => "credit",
    "secret_token"      => "generate_your_hash_secret_token",
    "start_unique_code" => 1,
    "end_unique_code"   => 999
  ];

  MootaWebhook::store($data);
  ```
  ### Destroy
  Delete list of webhook
  ```
  MootaWebhook::destroy('webhook_id');
  ```


## Merchant
  ### List
  List of merchant
  ```
    MootaMerchant::list();
  ```

  ### Store
  Create merchant data
  ```
    $data = [
      'logo' => 'image.png',
      'merchant_name' => '',
      'merchant_email' => '',
      'merchant_phone' => '',
      'address' => '',
      'business_type' => '',
      'website' => ''
    ];

    MootaMerchant::store($data);
  ```
  ### Store Legal
  create, add, or upload merchant legality files
  ```
    $data = [
      'type' => 'personal',
      'ktp_director_number' => '',
      'owner_ktp_file' => '',
      'owner_ktp_selfie_file' => '',
      'company_name' => '',
      'company_phone' => '',
      'company_email' => '',
      'siup_number' => '',
      'owner_npwp_file' => '',
      'company_npwp_file' => '',
      'company_siup_file' => '',
      'company_certificate_file' => '',
      'bank_account_id' => ''
    ];

    MootaMerchant::legal($data)->save();
  ```

  ### Update
  Update merchant data
  ```
    $data = [
      'logo' => 'image.png',
      'merchant_name' => '',
      'merchant_email' => '',
      'merchant_phone' => '',
      'address' => '',
      'business_type' => '',
      'website' => ''
    ];

    $merchantId = 'gQnp0VqzNrO';

    MootaMerchant::update($data, $merchantId);
  ```
  ### Update Legal
  Update merchant legality files
  ```
    $data = [
      'type' => 'personal',
      'ktp_director_number' => '',
      'owner_ktp_file' => '',
      'owner_ktp_selfie_file' => '',
      'company_name' => '',
      'company_phone' => '',
      'company_email' => '',
      'siup_number' => '',
      'owner_npwp_file' => '',
      'company_npwp_file' => '',
      'company_siup_file' => '',
      'company_certificate_file' => '',
      'bank_account_id' => ''
    ];

    $merchantId = 'gQnp0VqzNrO';

    MootaMerchant::legal($data, $merchantId)->save();
  ```

# Credit
- <a href='http://ecotrust-canada.github.io/markdown-toc/'>Moota</a>
- <a href='https://github.com/otnansirk/laravel-moota/graphs/contributors'>contributors</a>

# Contribution
This project is far from perfect. many Moota APIs that have not been implemented. I would be very happy if any of you could contribute for this project.

Fork this project and make merge request. :)
