<?php

namespace Otnansirk\Moota\Rules;

use Illuminate\Contracts\Validation\InvokableRule;


class AvailableBankType implements InvokableRule
{

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $bankTypes = [
            'bca',
            'btnBisnis',
            'bcaGiro',
            'bcaSyariah',
            'bni',
            'bniSyariah',
            'bniBisnis',
            'bniBisnisSyariah',
            'briCms',
            'briSyariahCms',
            'bri',
            'briGiro',
            'bsi',
            'bsiGiro',
            'mandiriOnline',
            'mandiriMcm2',
            'mandiriBisnis',
            'mandiriMcm',
            'megaSyariahCms',
            'muamalat',
            'mayBank',
            'ocbc',
            'ibbizBri',
            'bjbBisnis',
            'gojek'
        ];

        if (!in_array($value, $bankTypes)) {
            $fail(__("otnansirk/laravel-moota::moota.invalid-bank-type"));
        }
    }
}
