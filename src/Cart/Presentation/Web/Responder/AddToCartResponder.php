<?php declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Web\Responder;

use Marketplace\Cart\Business\Domain\Cart;
use Marketplace\Cart\Presentation\Web\Responder\Json\View\CartJsonView;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\stream_for;

class AddToCartResponder
{
    public function respond(Cart $cart, ResponseInterface $response): ResponseInterface
    {
        return $response->withBody(
            stream_for(
                json_encode(
                    new CartJsonView($cart)
                )
            )
        );
    }
}