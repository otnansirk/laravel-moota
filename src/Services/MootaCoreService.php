<?php

namespace Otnansirk\Moota\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Otnansirk\Moota\Exception\MootaCoreException;

class MootaCoreService
{

    private static $mootaData;

    private static $mootaBody;


    /**
     * Generate header
     *
     * @param string $path
     * @return array
     */
    public static function getHeader(string $path): array
    {
        return [
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
            'Location'      => $path,
            'Authorization' => 'Bearer '.config('moota.access_token', '')
        ];
    }

    /**
     * Api generator
     *
     * @param string $path
     * @param string $method
     * @param array $bodies
     * @return MootaCoreService
     */
    public static function api(string $path, string $method, array $bodies = []): MootaCoreService
    {
        $header = self::getHeader($path);
        $baseUrl = config('moota.api_url', '').'/'.config('moota.api_version', 'v2');
        $res = Http::withHeaders($header)
                    ->$method($baseUrl.$path, $bodies);

        if ($res->failed()) {
            Log::critical($res->body());
            if ($res->status() < 500) {
                throw new MootaCoreException($res->body(), $res->status());
            } else {
                throw new MootaCoreException(__("otnansirk/laravel-moota::moota.failed-create-contract"), 500);
            }
        }

        self::$mootaData = $res;
        self::$mootaBody = $res->json();

        return new self;
    }

    /**
     * Get all from api
     *
     * @return Http
     */
    public function all()
    {
        return self::$mootaData;
    }

    /**
     * Get json body from API request
     *
     * @return Json
     */
    public function body()
    {
        return self::$mootaBody;
    }

}