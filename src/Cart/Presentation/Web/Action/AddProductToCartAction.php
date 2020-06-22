<?php declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Web\Action;

use Marketplace\Cart\Business\Contract\CartServiceInterface;
use Marketplace\Cart\Presentation\Web\RequestHandler\AddToCartRequestHandler;
use Marketplace\Cart\Presentation\Web\Responder\AddToCartResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddProductToCartAction
{
    private CartServiceInterface $service;
    private AddToCartRequestHandler $requestHandler;
    private AddToCartResponder $responder;

    public function __construct(
        CartServiceInterface $service,
        AddToCartRequestHandler $requestHandler,
        AddToCartResponder $responder
    ) {
        $this->service = $service;
        $this->requestHandler = $requestHandler;
        $this->responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->responder->respond(
            $this->service->add(
                $this->requestHandler->getAddToCartInput($request)
            ),
            $response
        );
    }
}