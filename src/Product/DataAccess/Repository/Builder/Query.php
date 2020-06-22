<?php declare(strict_types=1);

namespace Marketplace\Product\DataAccess\Repository\Builder;

class Query
{
    private string $sql;
    private array $bindings = [];

    public function __construct(string $sql, array $bindings = [])
    {
        $this->sql = $sql;
        $this->bindings = $bindings;
    }

    public function getSql(): string
    {
        return $this->sql;
    }

    public function getBindings(): array
    {
        return $this->bindings;
    }
}