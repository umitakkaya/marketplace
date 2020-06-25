<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Web\Action;

use Marketplace\Cart\Business\Contract\CartServiceInterface;
use Marketplace\Cart\Presentation\Web\RequestHandler\AddToCartRequestHandler;
use Marketplace\Cart\Presentation\Web\Responder\AddToCartResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class AddProductToCartAction
{
    private CartServiceInterface $service;
    private AddToCartRequestHandler $requestHandler;
    private AddToCartResponder $responder;
    private LoggerInterface $logger;

    public function __construct(
        CartServiceInterface $service,
        AddToCartRequestHandler $requestHandler,
        AddToCartResponder $responder,
        LoggerInterface $logger
    ) {
        $this->service = $service;
        $this->requestHandler = $requestHandler;
        $this->responder = $responder;
        $this->logger = $logger;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        try {
            return $this->responder->respond(
                $this->service->add(
                    $this->requestHandler->getAddToCartInput($request)
                ),
                $response
            );
        } catch (\Throwable $t) {
            $this->logger->error(
                'Error while adding product to cart',
                [
                    'exception' => (string)$t,
                ]
            );

            throw $t;
        }
    }
}