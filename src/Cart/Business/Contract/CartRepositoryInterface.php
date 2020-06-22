<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Contract;

use Marketplace\Cart\Business\Domain\Cart;
use Ramsey\Uuid\UuidInterface;

interface CartRepositoryInterface
{
    public function get(UuidInterface $cartId): Cart;

    public function save(Cart $cart): void;
}