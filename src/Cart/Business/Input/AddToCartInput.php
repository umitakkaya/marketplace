<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Input;

use Ramsey\Uuid\UuidInterface;

class AddToCartInput
{
    private UuidInterface $cartId;
    private string $sku;
    private int $quantity;

    public function __construct(UuidInterface $cartId, string $sku, int $quantity)
    {
        $this->cartId = $cartId;
        $this->sku = $sku;
        $this->quantity = $quantity;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getCartId(): UuidInterface
    {
        return $this->cartId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}