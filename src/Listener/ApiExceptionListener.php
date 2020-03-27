<?php

namespace App\Listener;

use App\Exception\ApiExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {

        if (!$event->getThrowable() instanceof ApiExceptionInterface) {
            return;
        }
        $event->allowCustomResponseCode();
        $response = new JsonResponse($this->buildResponseData($event->getThrowable()));
        $response->setStatusCode($event->getThrowable()->getCode());
        $event->setResponse($response);

    }

    private function buildResponseData(ApiExceptionInterface $exception)
    {
        $messages = json_decode($exception->getMessage(), true);
        if (!is_array($messages)) {
            $messages = $exception->getMessage() ? [$exception->getMessage()] : [];
        }

        if (count($messages) == 1 and isset($messages[0])) {
            $messages = $messages[0];
        }

        return [
            'error' => [
                'status' => false,
                'code' => $exception->getCode(),
                'messages' => $messages
            ]];
    }
}