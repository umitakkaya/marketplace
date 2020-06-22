<?php declare(strict_types=1);

namespace Marketplace\Product\DataAccess\Mapper;

use Marketplace\Product\Business\Domain\Product;
use Marketplace\Product\Business\Domain\ProductCollection;

class ProductMapper
{
    public const KEY_SKU = 'sku';
    public const KEY_NAME = 'name';
    public const KEY_PRICE = 'price';
    public const KEY_BOX_SIZE_IN_CUBIC_METER = 'box_size_in_cubic_meter';

    public function mapToDomains(array $rawProducts): ProductCollection
    {
        return new ProductCollection(
            array_map([$this, 'mapOne'], $rawProducts)
        );
    }

    public function mapOne(array $rawProduct): Product
    {
        return new Product(
            $rawProduct[static::KEY_SKU],
            $rawProduct[static::KEY_NAME],
            $rawProduct[static::KEY_PRICE],
            $rawProduct[static::KEY_BOX_SIZE_IN_CUBIC_METER],
        );
    }
}