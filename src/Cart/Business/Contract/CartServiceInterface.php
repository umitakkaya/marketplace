<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Contract;

use Marketplace\Cart\Business\Domain\Cart;
use Marketplace\Cart\Business\Input\AddToCartInput;

interface CartServiceInterface
{
    public function add(AddToCartInput $input): Cart;
}