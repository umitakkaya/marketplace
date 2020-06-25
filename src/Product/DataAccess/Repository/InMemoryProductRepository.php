<?php
declare(strict_types=1);


namespace Marketplace\Product\DataAccess\Repository;

use Marketplace\Product\Business\Contract\ProductRepositoryInterface;
use Marketplace\Product\Business\Domain\ProductCollection;
use Marketplace\Product\Business\Domain\SearchRequest\ProductSearchRequest;
use Marketplace\Product\DataAccess\Mapper\ProductMapper;

class InMemoryProductRepository implements ProductRepositoryInterface
{
    private const IN_MEMORY_PRODUCTS = [
        [
            ProductMapper::KEY_SKU => 'MARKETPLACE-1',
            ProductMapper::KEY_NAME => 'Lamp',
            ProductMapper::KEY_PRICE => 200.0,
            ProductMapper::KEY_BOX_SIZE_IN_CUBIC_METER => 0.3
        ],
        [
            ProductMapper::KEY_SKU => 'MARKETPLACE-2',
            ProductMapper::KEY_NAME => 'Desk',
            ProductMapper::KEY_PRICE => 600.0,
            ProductMapper::KEY_BOX_SIZE_IN_CUBIC_METER => 2.7
        ]
    ];

    private ProductMapper $mapper;

    public function __construct(ProductMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get(ProductSearchRequest $searchRequest): ProductCollection
    {
        $matchedProducts = array_filter(
            static::IN_MEMORY_PRODUCTS,
            static function (array $rawProduct) use ($searchRequest) {
                return in_array($rawProduct['sku'], $searchRequest->getSkuList(), true);
            }
        );

        return $this->mapper->mapToDomains($matchedProducts);
    }
}