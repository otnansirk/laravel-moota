<?php

namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Services\Legal\LegalService;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaMerchantkService
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
            'page'    => 'numeric',
            'per_page' => 'numeric',
        ]);
        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = '/merchant';
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
        $path = '/merchant/store';
        $res = MootaCore::api($path, 'post', $data);

        return collect($res->body());
    }

    /**
     * Store data webhook
     *
     * @param array $data
     * @param string $merchantId
     * @return Collection
     */
    public function update(array $data, string $merchantId): Collection
    {
        $path = '/merchant/update/'.$merchantId;
        $res = MootaCore::api($path, 'post', $data);

        return collect($res->body());
    }

    /**
     * Legal class
     *
     * @param array $data
     * @param string|null $id
     * @return LegalService
     */
    public function legal(array $data, string $id = null)
    {
        return new LegalService($data, $id);
    }
}
