<?php

declare(strict_types=1);

namespace Otnansirk\Moota\Exception;

use LogicException;

class MootaCoreException extends LogicException
{
    public function __construct($msg, $code) {
        parent::__construct($msg, $code);
    }
}
