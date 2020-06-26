<?php declare(strict_types=1);

namespace Marketplace\Cart\Business\Service;

use Marketplace\Cart\Business\Contract\CartRepositoryInterface;
use Marketplace\Cart\Business\Contract\CartServiceInterface;
use Marketplace\Cart\Business\Contract\ProductNotFoundException;
use Marketplace\Cart\Business\Contract\ProductRepositoryInterface;
use Marketplace\Cart\Business\Domain\Cart;
use Marketplace\Cart\Business\Domain\CartItem;
use Marketplace\Cart\Business\Input\AddToCartInput;

class CartService implements CartServiceInterface
{
    private CartRepositoryInterface $cartRepository;
    private ProductRepositoryInterface $productRepository;

    public function __construct(CartRepositoryInterface $cartRepository, ProductRepositoryInterface $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }


    /**
     * @param AddToCartInput $input
     *
     * @return Cart
     *
     * @throws ProductNotFoundException
     */
    public function add(AddToCartInput $input): Cart
    {
        $product = $this->productRepository->get($input->getSku());

        $cart = $this->cartRepository->get($input->getCartId());

        $cart->add(new CartItem($product, $input->getQuantity()));
        
        $this->cartRepository->save($cart);

        return $cart;
    }
}
