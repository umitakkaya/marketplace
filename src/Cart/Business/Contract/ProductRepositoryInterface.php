<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Contract;

use Marketplace\Cart\Business\Domain\Product;

interface ProductRepositoryInterface
{
    /**
     * @param string $sku
     *
     * @return Product
     *
     * @throws ProductNotFoundException
     */
    public function get(string $sku): Product;
}