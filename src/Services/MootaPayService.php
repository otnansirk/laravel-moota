<?php

namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Otnansirk\Moota\Facades\MootaCore;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Helpers\CreateCallback;
use Otnansirk\Moota\Helpers\CreateContract;
use Otnansirk\Moota\Exception\MootaCoreException;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaPayService
{

    private $contractData;

    /**
     * Create contract to moota server
     *
     * @param array|null $bodies
     * @return Collection
     */
    public function contract(mixed $bodies = []): MootaPayService
    {
        if (count($bodies)) {
            $orderData = new CreateContract($bodies);
            $validate = Validator::make($orderData->payload(), [
                'invoice_number'    => 'required',
                'payment_method_id' => 'required',
                'amount'            => 'required',
                'callback_url'      => 'required',
                'items.*.name'      => 'required',
                'items.*.qty'       => 'required',
                'items.*.price'     => 'required',
                'items.*.sku'       => 'required',
                'items.*.image_url' => 'required',
                'callback_url'      => 'required',
            ]);

            if ($validate->fails()) {
                Log::warning($validate->errors());
                throw new MootaCore400Exception($validate);
            }

            $this->contractData = $orderData->payload();
        }

        return $this;
    }

    /**
     * Save contract to moota server
     *
     * @return void
     */
    public function save()
    {

        $path = "/contract";
        $res = MootaCore::api($path, 'post', $this->contractData);

        return collect(collect($res->body())->get('data', []));
    }

    /**
     * Get transaction list
     *
     * @return Collection
     */
    public function list(): Collection
    {
        $path = '/contract';
        $res  = MootaCore::api($path, 'get');
        return collect($res->body());
    }

    /**
     * Get payment method list
     *
     * @return Collection
     */
    public function method(): Collection
    {
        $path = '/payment-method';
        $res  = MootaCore::api($path, 'get');
        return collect($res->body());
    }

    /**
     * Cancel the transaction with this method
     *
     * @param string $trxId
     * @return Collection
     */
    public function canceled(string $trxId): Collection
    {
        $path = "/contract/cancel/".$trxId;
        $res  = MootaCore::api($path, 'post');
        return collect($res->body());
    }

    /**
     * Get plugin token
     *
     * @return Collection
     */
    public function pluginToken(): Collection
    {
        $path = "/plugin/token";
        $res  = MootaCore::api($path, 'get');
        return collect($res->body());
    }

    /**
     * Test webhook
     * You will receive this data from the webhook url that you have registered
     * If you leave data blank, this method will generate your callback data from faker api.
     *
     * @param array $bodies
     * @return Collection
     */
    public function callback(array $bodies = []): Collection
    {
        $data = new CreateCallback($bodies);
        $path = config('moota.web_url', '')."/questions";
        $res  = Http::post($path, $data->payload());
        if ($res->failed()) {
            throw new MootaCoreException(__("otnansirk/laravel-moota::moota.failed-create-contract"), 500);
        }

        return collect($res->body());
    }
}
