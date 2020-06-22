<?php declare(strict_types=1);

namespace Marketplace\Product\DataAccess\Repository\Builder;

use Marketplace\Product\Business\Domain\SearchRequest\ProductSearchRequest;

class ProductQueryBuilder
{
    public function buildSelectQuery(ProductSearchRequest $searchRequest): Query
    {
        $sql = sprintf(
            'SELECT 
                sku,
                `name`,
                price,
                box_size_in_cubic_meter
            FROM product
            WHERE sku IN (%s)
            ',
            rtrim(
                str_repeat(
                    '?,',
                    count($searchRequest->getSkuList())
                ),
                ','
            ),
        );

        return new Query($sql, array_values($searchRequest->getSkuList()));
    }
}