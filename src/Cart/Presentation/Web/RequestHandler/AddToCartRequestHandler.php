<?php declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Web\RequestHandler;

use Marketplace\Cart\Business\Input\AddToCartInput;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;

class AddToCartRequestHandler
{
    public function getAddToCartInput(ServerRequestInterface $request): AddToCartInput
    {
        $parsedBody = $request->getParsedBody();

        return new AddToCartInput(
            Uuid::fromString($request->getAttribute('cart_id')),
            $parsedBody['sku'],
            $parsedBody['quantity']
        );
    }
}