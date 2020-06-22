<?php declare(strict_types=1);

namespace Marketplace\Cart\DataAccess\Repository;

use Marketplace\Cart\Business\Contract\CartRepositoryInterface;
use Marketplace\Cart\Business\Domain\Cart;
use Psr\SimpleCache\CacheInterface;
use Ramsey\Uuid\UuidInterface;

class CartRepository implements CartRepositoryInterface
{
    public function get(UuidInterface $cartId): Cart
    {
        return new Cart($cartId, []);
    }

    public function save(Cart $cart): void
    {
        // noop
    }
}