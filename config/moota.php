<?php

return [

    /**
     * This code sets the value of the "access_token" variable to the value of
     * the MOOTA_ACCESS_TOKEN environment variable, or to null if the
     * environment variable is not set.
     */
    "access_token" => env("MOOTA_ACCESS_TOKEN", null),

    /**
     * Set currency
     */
    "currency" => env('MOOTA_CURRENCY', "IDR"),


    /**
     * API url for moota app
     */
    "api_url" => env('MOOTA_API_URL', 'https://app.moota.co/api'),

    /**
     * API version
     */
    "api_version" => env('MOOTA_API_VERSION', 'v2'),

    /**
     * Number 1 | 0
     * 1 For use unique code form moota
     * 0 For manual generate unique code from our system
     */
    "with_unique_code" => env("MOOTA_WITH_UNIQUE_CODE", 1),

    /**
     * Number
     * For setup start of unique code will generate from moota
     */
    "start_unique_code" => env("MOOTA_START_UNIQUE_CODE", 1),

    /**
     * Number
     * For setup end of unique code will generate from moota
     */
    "end_unique_code" => env("MOOTA_END_UNIQUE_CODE", 999),

    /**
     * Number 1 | 0
     * 1 for a increase in the total, it will be generated from moota
     * 0 for a decrease in the total, it will be generated from moota
     */
    "increase_total_from_unique_code" => env("MOOTA_INCREASE_TOTAL_FROM_UNIQUE_CODE", 1),

    /**
     * String
     * For a callback if the payment was successfully made by the customer or other information if
     * there is a change in the transaction
     */
    "callback_url" => env("MOOTA_CALLBACK_URL", ""),

    /**
     * Number
     * For expired date after. Unit is minutes
     */
    "expired_after" => env("MOOTA_EXPIRED_AFTER", 60), // Equivalent to 1 hours

    /**
     * String
     * For date format
     */
    "date_format" => "Y-m-d H:i:s",

    /**
     * String
     * For set timezone
     */
    "timezone" => "Asia/Jakarta",
];
