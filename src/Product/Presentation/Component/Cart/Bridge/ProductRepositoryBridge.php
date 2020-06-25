<?php declare(strict_types=1);

namespace Marketplace\Product\Presentation\Component\Cart\Bridge;

use Marketplace\Cart\Business\Contract\ProductNotFoundException;
use Marketplace\Cart\Business\Contract\ProductRepositoryInterface as RemoteProductRepositoryInterface;
use Marketplace\Cart\Business\Domain\Product;
use Marketplace\Product\Business\Contract\ProductRepositoryInterface as LocalProductRepositoryInterface;
use Marketplace\Product\Business\Domain\SearchRequest\ProductSearchRequest;
use Marketplace\Product\Presentation\Component\Cart\Bridge\Mapper\ProductResponseMapper;

class ProductRepositoryBridge implements RemoteProductRepositoryInterface
{
    private LocalProductRepositoryInterface $localProductRepository;
    private ProductResponseMapper $responseMapper;

    public function __construct(LocalProductRepositoryInterface $localProductRepository, ProductResponseMapper $responseMapper)
    {
        $this->localProductRepository = $localProductRepository;
        $this->responseMapper = $responseMapper;
    }

    public function get(string $sku): Product
    {
        $productSearchRequest = (new ProductSearchRequest)->withSkuList([$sku]);

        $products = $this->localProductRepository->get($productSearchRequest);

        if ($products->isEmpty())
        {
            throw ProductNotFoundException::createNotFoundUsingSku($sku);
        }

        return $this->responseMapper->mapToDomain($products->first());
    }
}