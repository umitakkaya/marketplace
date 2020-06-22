<?php declare(strict_types=1);

namespace Marketplace\Product\DataAccess\Repository;

use Marketplace\Product\Business\Contract\ProductRepositoryInterface;
use Marketplace\Product\Business\Domain\ProductCollection;
use Marketplace\Product\Business\Domain\SearchRequest\ProductSearchRequest;
use Marketplace\Product\DataAccess\Mapper\CachedProductMapper;
use Marketplace\Product\DataAccess\Repository\Builder\ProductQueryCacheKeyBuilder;
use Psr\SimpleCache\CacheInterface;

class CachedProductRepository implements ProductRepositoryInterface
{
    private CacheInterface $cache;
    private ProductRepositoryInterface $repository;
    private ProductQueryCacheKeyBuilder $cacheKeyBuilder;
    private CachedProductMapper $mapper;

    public function __construct(
        CacheInterface $cache,
        ProductRepositoryInterface $repository,
        ProductQueryCacheKeyBuilder $cacheKeyBuilder,
        CachedProductMapper $mapper
    ) {
        $this->cache = $cache;
        $this->repository = $repository;
        $this->cacheKeyBuilder = $cacheKeyBuilder;
        $this->mapper = $mapper;
    }


    public function get(ProductSearchRequest $searchRequest): ProductCollection
    {
        $cacheKey = $this->cacheKeyBuilder->build($searchRequest);

        return $this->cache->has($cacheKey)
            ? $this->getFromCache($cacheKey)
            : $this->getFromRepository($cacheKey, $searchRequest);
    }

    private function getFromCache(string $cacheKey): ProductCollection
    {
        return $this->mapper->mapToDomains($this->cache->get($cacheKey));
    }

    private function getFromRepository(string $cacheKey, ProductSearchRequest $searchRequest): ProductCollection
    {
        $products = $this->repository->get($searchRequest);

        $this->cache->set($cacheKey, $this->mapper->mapToJson($products));

        return $products;
    }
}