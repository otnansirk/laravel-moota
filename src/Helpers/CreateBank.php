<?php

namespace Otnansirk\Moota\Helpers;

class CreateBank
{

    public $data;

    public function __construct(array $data)
    {
        $this->data = collect($data);
    }

    public function payload()
    {
        return [
            "corporate_id"  => $this->data->get('corporate_id', ''),
            "bank_type"     => $this->data->get('bank_type', ''),
            "username"      => $this->data->get('username', ''),
            "password"      => $this->data->get('password', ''),
            "name_holder"   => $this->data->get('name_holder', ''),
            "account_number"=> $this->data->get('account_number', ''),
            "is_active"     => $this->data->get('is_active', true)
        ];
    }
}
