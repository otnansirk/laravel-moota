<?php

declare(strict_types=1);

namespace Otnansirk\Moota\Exception;

use LogicException;
use Illuminate\Validation\Validator;

class MootaCore400Exception extends LogicException
{

    public function __construct(Validator $res)
    {
        $er = implode(', ', $res->errors()->all());
        parent::__construct($er, 400);
    }
}
