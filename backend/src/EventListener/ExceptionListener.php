<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof UnprocessableEntityHttpException) {
     
            $validationException = $exception->getPrevious();
            
        
            if ($validationException instanceof ValidationFailedException) {
                $violations = $validationException->getViolations();
                $errorMessages = [];

                foreach ($violations as $violation) {
                    $errorMessages[] = [
                        'field' => $violation->getPropertyPath(),
                        'message' => $violation->getMessage(),
                    ];
                }

               
                $response = new JsonResponse([
                    'error' => true,
                    'errors' => $errorMessages,
                ], JsonResponse::HTTP_BAD_REQUEST);

                $event->setResponse($response);
                return;
            }
        }

        $response = [
            'error' => true,
            'errors' => $exception->getMessage(),
        ];

        $statusCode = $exception instanceof HttpExceptionInterface
            ? $exception->getStatusCode()
            : $exception->getCode();

        $event->setResponse(new JsonResponse($response, $statusCode));
    }
}
