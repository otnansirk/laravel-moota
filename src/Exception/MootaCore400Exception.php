<?php

declare(strict_types=1);

namespace Otnansirk\Moota\Exception;

use LogicException;

class MootaCore400Exception extends LogicException
{

    public function __construct()
    {
        parent::__construct("Bad Request", 400);
    }
}
