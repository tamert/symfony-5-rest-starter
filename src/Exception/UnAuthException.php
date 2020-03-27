<?php

namespace App\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnAuthException extends Exception implements ApiExceptionInterface
{
    public function __construct($code = Response::HTTP_UNAUTHORIZED, Exception $previous = null)
    {
        parent::__construct("unAuthorized", $code, $previous);
    }
}