<?php declare(strict_types=1);

namespace Marketplace\Product\Presentation\Component\Cart\Bridge\Mapper;

use Marketplace\Cart\Business\Domain\Product as LocalProduct;
use Marketplace\Product\Business\Domain\Product as RemoteProduct;

class ProductResponseMapper
{
    public function mapToDomain(RemoteProduct $remoteProduct): LocalProduct
    {
        return new LocalProduct(
            $remoteProduct->getSku(),
            $remoteProduct->getName(),
            $remoteProduct->getPrice()
        );
    }
}