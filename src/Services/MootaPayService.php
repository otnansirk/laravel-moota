<?php

namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Helpers\CreateContract;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaPayService
{

    /**
     * Create order
     *
     * @param array $bodies
     * @return Collection
     */
    public function contract(array $bodies): Collection
    {

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

        $path = "/contract";
        $res = MootaCore::api($path, 'post', $orderData->payload());

        return collect(collect($res->body())->get('data', []));
    }
}
