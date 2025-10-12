<?php

namespace App\Exceptions;

use Exception;

class UserPhoneExistException extends Exception
{
    public $status = 400;
}
