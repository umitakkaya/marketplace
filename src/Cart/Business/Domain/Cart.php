<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Domain;

use ArrayIterator;
use Iterator;
use IteratorAggregate;
use Ramsey\Uuid\UuidInterface;
use Webmozart\Assert\Assert;

class Cart implements IteratorAggregate
{
    private UuidInterface $cartId;

    /** @var CartItem[] */
    private array $items;

    /**
     * @param UuidInterface $cartId
     * @param CartItem[] $items
     */
    public function __construct(UuidInterface $cartId, array $items = [])
    {
        Assert::allIsInstanceOf(CartItem::class, $items);

        $this->items = $items;
        $this->cartId = $cartId;
    }

    public function cartTotal(): float
    {
        return array_reduce(
            $this->items,
            fn(float $carry, CartItem $item) => $carry + $item->price(),
            0.0
        );
    }

    public function add(CartItem $itemToAdd): void
    {
        foreach ($this->items as $item) {
            if ($item->equalsTo($itemToAdd)) {
                $item->combine($itemToAdd);
                return;
            }
        }

        $this->items[] = $itemToAdd;
    }

    /**
     * @return CartItem[]|Iterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}