<?php

namespace App\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BadRequestException
 * @package App\Exception
 */
class BadRequestException extends Exception implements ApiExceptionInterface
{
    /**
     * BadRequestException constructor.
     * @param $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(
        $message,
        $code = Response::HTTP_BAD_REQUEST,
        Exception $previous = null
    )
    {
        if(is_array($message))
        {
            $message = json_encode($message);
        }
        parent::__construct($message, $code, $previous);
    }
}