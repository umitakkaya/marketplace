<?php declare(strict_types=1);

namespace Marketplace\Product\DataAccess\Repository;

use PDO;

interface PdoConnectionFactoryInterface
{
    public function create(): PDO;
}