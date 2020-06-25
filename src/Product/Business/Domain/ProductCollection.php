<?php declare(strict_types=1);

namespace Marketplace\Product\Business\Domain;

use IteratorAggregate;
use Webmozart\Assert\Assert;

class ProductCollection implements IteratorAggregate
{

    /** @var Product[] */
    private $items;

    /**
     * @param Product[] $items
     */
    public function __construct(array $items)
    {
        Assert::allIsInstanceOf($items, Product::class);

        $this->items = $items;
    }

    public function first(): ?Product
    {
        return reset($this->items) ?: null;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}