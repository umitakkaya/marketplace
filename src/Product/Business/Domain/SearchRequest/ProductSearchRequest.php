<?php declare(strict_types=1);

namespace Marketplace\Product\Business\Domain\SearchRequest;

use Webmozart\Assert\Assert;

class ProductSearchRequest
{
    /** @var string[] */
    private $skuList = [];

    /**
     * @return string[]
     */
    public function getSkuList(): array
    {
        return $this->skuList;
    }

    public function withSkuList(array $skuList): self
    {
        Assert::allString($skuList);

        $clone = clone $this;
        $clone->skuList = $skuList;
        return $clone;
    }
}