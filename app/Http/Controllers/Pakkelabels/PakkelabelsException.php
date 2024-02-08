<?php

namespace App\Http\Controllers\Pakkelabels;

use Exception;

class PakkelabelsException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}

