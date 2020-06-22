<?php declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Web\Responder\Json\View;

use JsonSerializable;
use Marketplace\Cart\Business\Domain\CartItem;

class CartItemJsonView implements JsonSerializable
{
    private CartItem $item;

    public function __construct(CartItem $item)
    {
        $this->item = $item;
    }

    public function jsonSerialize()
    {
        return [
            'price' => $this->item->price(),
            'quantity' => $this->item->getQuantity(),
            'product' => new ProductJsonView($this->item->getProduct()),
        ];
    }
}