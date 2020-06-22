<?php declare(strict_types=1);


namespace Marketplace\Product\DataAccess\Repository;

use Marketplace\Product\Business\Contract\ProductRepositoryInterface;
use Marketplace\Product\Business\Domain\ProductCollection;
use Marketplace\Product\Business\Domain\SearchRequest\ProductSearchRequest;
use Marketplace\Product\DataAccess\Mapper\ProductMapper;
use Marketplace\Product\DataAccess\Repository\Builder\ProductQueryBuilder;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{
    private ProductQueryBuilder $queryBuilder;
    private ProductMapper $mapper;
    private PdoConnectionFactoryInterface $connectionFactory;

    public function __construct(
        ProductQueryBuilder $queryBuilder,
        ProductMapper $mapper,
        PdoConnectionFactoryInterface $connectionFactory
    ) {
        $this->queryBuilder = $queryBuilder;
        $this->mapper = $mapper;
        $this->connectionFactory = $connectionFactory;
    }

    public function get(ProductSearchRequest $searchRequest): ProductCollection
    {
        $query = $this->queryBuilder->buildSelectQuery($searchRequest);
        $pdo = $this->connectionFactory->create();
        $statement = $pdo->prepare($query->getSql());

        $statement->execute($query->getBindings());

        return $this->mapper->mapToDomains(
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }
}