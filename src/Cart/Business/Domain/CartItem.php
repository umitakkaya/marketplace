<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Domain;

use Webmozart\Assert\Assert;

class CartItem
{
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        Assert::greaterThan($quantity, 0);

        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function equalsTo(CartItem $itemToCompare): bool
    {
        return $this->product->getSku() === $itemToCompare->product->getSku();
    }

    public function combine(CartItem $itemToCombine): void
    {
        $this->quantity += $itemToCombine->quantity;
    }

    public function price(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}