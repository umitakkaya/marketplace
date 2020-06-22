<?php declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Web\Responder\Json\View;

use JsonSerializable;
use Marketplace\Cart\Business\Domain\Cart;
use Marketplace\Cart\Business\Domain\CartItem;

class CartJsonView implements JsonSerializable
{
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function jsonSerialize()
    {
        return [
            'cart_total' => $this->cart->cartTotal(),
            'items' => array_map(
                fn(CartItem $item) => new CartItemJsonView($item),
                iterator_to_array($this->cart->getIterator())
            )
        ];
    }
}