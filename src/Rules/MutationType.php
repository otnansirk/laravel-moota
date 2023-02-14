<?php

namespace Otnansirk\Moota\Rules;

use Illuminate\Contracts\Validation\InvokableRule;


class MutationType implements InvokableRule
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

        $bankTypes = ['CR','DB','credit','debit'];
        if (!in_array($value, $bankTypes)) {
            $fail(__("otnansirk/laravel-moota::moota.invalid-mutation-type"));
        }
    }
}
