<?php
namespace Commissions;

use Exception;

class MalformatException extends Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}