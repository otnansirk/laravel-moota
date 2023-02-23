<?php

namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Services\Point\PointService;
use Otnansirk\Moota\Exception\MootaCoreException;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaTopupService
{
    private $topupData;

    /**
     * Topup point to moota
     *
     * @param mixed $bodies
     * @return MootaTopupService
     */
    public function topup(mixed $bodies = []): MootaTopupService
    {
        if (count($bodies)) {
            $validate = Validator::make($bodies, [
                'amount'         => 'required',
                'payment_method' => 'required',
            ]);
            if ($validate->fails()) {
                Log::warning($validate->errors());
                throw new MootaCore400Exception($validate);
            }

            $this->topupData = $validate->validated();
        }

        return $this;
    }

    /**
     * Create topup point
     *
     * @return Collection
     */
    public function save(): Collection
    {
        if (!$this->topupData) {
            throw new MootaCoreException(__("otnansirk/laravel-moota::moota.topup-data-not-valid"), 400);
        }

        $path = "/topup";
        $res = MootaCore::api($path, 'post', $this->topupData);

        return collect($res->body());
    }

    /**
     * List of bank where to topup
     *
     * @return Collection
     */
    public function to(): Collection
    {
        $path = "/payment";
        $res = MootaCore::api($path, 'get');

        return collect($res->body());
    }


    /**
     * History of topup
     *
     * @return Collection
     */
    public function history(): Collection
    {
        $path = "/topup";
        $res = MootaCore::api($path, 'get');

        return collect($res->body());
    }

    /**
     * Point
     *
     * @return Collection
     */
    public function point()
    {
        return new PointService();
    }

    /**
     * Redeem code
     *
     * @param string $code
     * @return Collection
     */
    public function redeem(string $code): Collection
    {
        $path = "/voucher/redeem";
        $res = MootaCore::api($path, 'post', ['code' => $code]);

        return collect($res->body());
    }

}
