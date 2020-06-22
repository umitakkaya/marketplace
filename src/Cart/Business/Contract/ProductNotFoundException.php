<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Contract;

use DomainException;

class ProductNotFoundException extends DomainException
{
    public static function createNotFoundUsingSku(string $sku): self
    {
        return new static(
            sprintf('Product with SKU "%s" not found', $sku)
        );
    }
}