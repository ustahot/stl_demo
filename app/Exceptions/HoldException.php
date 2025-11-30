<?php

namespace App\Exceptions;

use Exception;

class HoldException extends Exception
{
    /**
     * @throws HoldException
     */
    public static function throwConflict()
    {
        throw new self('Conflict', 409);
    }
}
