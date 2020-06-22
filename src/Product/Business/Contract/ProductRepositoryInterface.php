<?php declare(strict_types=1);

namespace Marketplace\Product\Business\Contract;

use Marketplace\Product\Business\Domain\ProductCollection;
use Marketplace\Product\Business\Domain\SearchRequest\ProductSearchRequest;

interface ProductRepositoryInterface
{
    public function get(ProductSearchRequest $searchRequest): ProductCollection;
}