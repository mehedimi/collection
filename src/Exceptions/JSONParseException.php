<?php

namespace Mehedi\Exceptions;

use Exception;

class JSONParseException extends Exception
{
    protected $message = 'We could not parse that data into JSON.';
}
