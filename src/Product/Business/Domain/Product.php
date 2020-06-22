<?php declare(strict_types=1);


namespace Marketplace\Product\Business\Domain;

use Webmozart\Assert\Assert;

class Product
{
    private string $sku;
    private string $name;
    private float $price;
    private float $boxSizeInCubicMeter;

    public function __construct(string $sku, string $name, float $price, float $boxSizeInCubicMeter)
    {
        Assert::notEmpty($name);
        Assert::greaterThan($price, 0);
        Assert::greaterThan($boxSizeInCubicMeter, 0);

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->boxSizeInCubicMeter = $boxSizeInCubicMeter;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getBoxSizeInCubicMeter(): float
    {
        return $this->boxSizeInCubicMeter;
    }
}