<?php

declare(strict_types=1);

namespace Otnansirk\Moota\Exception;

use LogicException;

class MootaCore404Exception extends LogicException
{
    public function __construct()
    {
        parent::__construct("Not Found", 404);
    }
}
