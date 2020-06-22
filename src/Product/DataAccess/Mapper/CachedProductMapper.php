<?php declare(strict_types=1);

namespace Marketplace\Product\DataAccess\Mapper;

use Marketplace\Product\Business\Domain\Product;
use Marketplace\Product\Business\Domain\ProductCollection;

class CachedProductMapper
{
    private ProductMapper $productMapper;

    public function __construct(ProductMapper $productMapper)
    {
        $this->productMapper = $productMapper;
    }

    public function mapToDomains(string $json): ProductCollection
    {
        return $this->productMapper->mapToDomains(json_decode($json, true));
    }

    public function mapToJson(ProductCollection $products): string
    {
        return json_encode(
            array_map(
                static function (Product $product) {
                    return [
                        ProductMapper::KEY_SKU => $product->getSku(),
                        ProductMapper::KEY_NAME => $product->getName(),
                        ProductMapper::KEY_PRICE => $product->getPrice(),
                        ProductMapper::KEY_BOX_SIZE_IN_CUBIC_METER => $product->getBoxSizeInCubicMeter()
                    ];
                },
                iterator_to_array($products)
            ),
            JSON_PRESERVE_ZERO_FRACTION
        );
    }
}