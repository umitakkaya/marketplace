<?php declare(strict_types=1);

namespace Marketplace\Product\Business\Service;

use Marketplace\Product\Business\Contract\ProductRepositoryInterface;
use Marketplace\Product\Business\Contract\ProductServiceInterface;
use Marketplace\Product\Business\Domain\ProductCollection;
use Marketplace\Product\Business\Domain\SearchRequest\ProductSearchRequest;

class ProductService implements ProductServiceInterface
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(ProductSearchRequest $searchRequest): ProductCollection
    {
        return $this->repository->get($searchRequest);
    }
}