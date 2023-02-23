<?php

namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaWebhookService
{

    /**
     * Get list off webhook
     *
     * @param string $code
     * @return Collection
     */
    public function list(array $filters = []): Collection
    {
        $validate = Validator::make($filters, [
            'url'     => 'string',
            'bank_id' => 'string',
            'page'    => 'numeric',
            'per_page' => 'numeric',
        ]);
        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = '/integration/webhook';
        $res = MootaCore::api($path, 'get', $validate->validated());

        return collect($res->body());
    }

    /**
     * Store data webhook
     *
     * @param array $data
     * @return Collection
     */
    public function store(array $data): Collection
    {
        $validate = Validator::make($data, [
            'url'               => 'string',
            'bank_account_id'   => 'string',
            'kinds'             => 'string',
            'secret_token'      => 'string',
            'start_unique_code' => 'numeric',
            'end_unique_code'   => 'numeric'
        ]);
        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = '/integration/webhook';
        $res = MootaCore::api($path, 'post', $validate->validated());

        return collect($res->body());
    }

    /**
     * Destroy webhook
     *
     * @param string $webhookId
     * @return Collection
     */
    public function destroy(string $webhookId): Collection
    {

        $path = '/integration/webhook/'.$webhookId;
        $res = MootaCore::api($path, 'delete');

        return collect($res->body());
    }
}
