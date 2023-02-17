<?php

namespace Otnansirk\Moota\Helpers;

use Illuminate\Support\Collection;


class CreateCallback
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = collect($data);
    }

    public function payload(): array
    {
        $num = fake()->randomNumber(5, true);
        return [
            'total'             => $this->data->get('total', $num),
            'amount'            => $this->data->get('amount', $num),
            'trx_id'            => $this->data->get('trx_id', fake()->numerify('TRX-#####-#####-#####-#####')),
            'created_at'        => $this->data->get('created_at', fake()->date('Y-m-d h:i:s')),
            'invoice_number'    => $this->data->get('invoice_number', fake()->numerify('INC-#####-#####')),
            'payment_at'        => $this->data->get('payment_at', fake()->date('Y-m-d h:i:s')),
            'unique_code'       => $this->data->get('unique_code', "0"),
            'expired_date'      => $this->data->get('expired_date', fake()->date('Y-m-d h:i:s')),
            'payment_method_id' => $this->data->get('payment_method_id', fake()->bothify('???????????')),
        ];
    }
}
