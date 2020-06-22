<?php declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Web\Responder\Json\View;

use Marketplace\Cart\Business\Domain\Product;

class ProductJsonView implements \JsonSerializable
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function jsonSerialize()
    {
        return [
            'sku' => $this->product->getSku(),
            'name' => $this->product->getName(),
            'price' => $this->product->getPrice(),
        ];
    }
}