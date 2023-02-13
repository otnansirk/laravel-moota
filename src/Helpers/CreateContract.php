<?php
namespace Otnansirk\Moota\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class CreateContract
{

    public $order;
    public $currency;
    public $invoiceNumber;

    public function __construct($data)
    {
        $this->currency      = config('moota.currency');
        $this->order         = collect($data);
        $this->invoiceNumber = $this->order->get("invoice_number", Str::uuid()->toString());
    }

    public function get(): Collection
    {
        $orderData = [
            "invoice_number"    => $this->invoiceNumber,
            "amount"            => $this->order->get('amount', 0),
            "payment_method_id" => $this->order->get('payment_method_id', 0),
            "callback_url"      => $this->order->get('callback_url', config('moota.callback_url', '')),
            "expired_date"      => Carbon::now()
                                    ->setTimezone(config('moota.timezone', 'Asia/Jakarta'))
                                    ->addMinutes((int)config('moota.expired_after', 60))
                                    ->format(config('moota.date_format')),
            "description"       => $this->order->get('description', ''),
            "unique_code"       => $this->order->get('unique_code', 0),
            "with_unique_code"  => config('moota.with_unique_code', 0),
            "start_unique_code" => config('moota.start_unique_code', 0),
            "end_unique_code"   => config('moota.end_unique_code', 999),
            "customer"          => $this->customer($this->order->get('customer', [])),
            "items"             => collect($this->order->get('items', []))->map(function($item) {
                                        return $this->items($item);
                                    }),
            "increase_total_from_unique_code" => config('moota.increase_total_from_unique_code', 1),
        ];

        return collect($orderData);
    }

    public function customer(array $customer)
    {
        return [
            'name'  => collect($customer)->get('name', ''),
            'email' => collect($customer)->get('email', ''),
            'phone' => collect($customer)->get('phone', '')
        ];
    }

    public function items(array $item)
    {
        return [
            "name"      => collect($item)->get('name', ''),
            "qty"       => collect($item)->get('qty', 1),
            "price"     => collect($item)->get('price', ''),
            "sku"       => collect($item)->get('sku', ''),
            "image_url" => collect($item)->get('image_url', '')
        ];
    }

    public function payload(): array
    {
        return $this->get()->toArray();
    }
}
