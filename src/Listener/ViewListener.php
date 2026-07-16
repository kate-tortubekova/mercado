<?php

namespace App\Listener;

use App\Attribute\ApiResponse;
use ReflectionMethod;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse as SymfonyJsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Serializer\SerializerInterface;

#[AsEventListener(event: 'kernel.view')]
class ViewListener
{
    public function __construct(
        private SerializerInterface $serializer
    ) {}

    public function onKernelView(ViewEvent $event): void
    {
        $result = $event->getControllerResult();
        
        if ($result === null || $result instanceof Response) {
            return;
        }

        $request = $event->getRequest();
        $controller = $request->attributes->get('_controller');

        if (!is_string($controller) || !str_contains($controller, '::')) {
            return;
        }

        [$class, $method] = explode('::', $controller);
        $reflection = new ReflectionMethod($class, $method);
        
        $attributes = $reflection->getAttributes(ApiResponse::class);

        if (empty($attributes)) {
            return;
        }

        $firstAttribute = $attributes[0];

        /** @var ApiResponse $jsonResponseAttribute */
        $jsonResponseAttribute = $firstAttribute->newInstance();

        $jsonContent = $this->serializer->serialize($result, 'json');

        $response = new SymfonyJsonResponse($jsonContent, $jsonResponseAttribute->status, [], true);

        $event->setResponse($response);
    }
}
