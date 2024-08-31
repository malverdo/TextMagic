<?php

namespace App\Application\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionMonologListener
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $error = [
            'class' => $exception::class,
            'Message' => $exception->getMessage(),
            'File' => $exception->getFile(),
            'Line' => $exception->getLine(),
            'TraceAsString' => $exception->getTraceAsString(),
        ];
        $this->logger->error('Exception ' . $exception->getMessage(), $error);
    }
}