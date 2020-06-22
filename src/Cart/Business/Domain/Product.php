<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Domain;

class Product
{
    private string $sku;
    private string $name;
    private float $price;

    public function __construct(string $sku, string $name, float $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}