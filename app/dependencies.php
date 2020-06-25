<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Marketplace\Cart\Business\Contract\CartServiceInterface;
use Marketplace\Cart\Business\Service\CartService;
use Marketplace\Cart\Presentation\Web\Action\AddProductToCartAction;
use Marketplace\Cart\Presentation\Web\RequestHandler\AddToCartRequestHandler;
use Marketplace\Cart\Presentation\Web\Responder\AddToCartResponder;
use Marketplace\Product\Presentation\Component\Cart\Bridge\ProductRepositoryBridge;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions(
        [
            LoggerInterface::class => function (ContainerInterface $c) {
                $settings = $c->get('settings');

                $loggerSettings = $settings['logger'];
                $logger = new Logger($loggerSettings['name']);

                $processor = new UidProcessor();
                $logger->pushProcessor($processor);

                $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
                $logger->pushHandler($handler);

                return $logger;
            },
            Marketplace\Product\Business\Contract\ProductRepositoryInterface::class => function (ContainerInterface $c
            ) {
                return new \Marketplace\Product\DataAccess\Repository\InMemoryProductRepository(
                    new \Marketplace\Product\DataAccess\Mapper\ProductMapper()
                );
            },
            Marketplace\Cart\Business\Contract\ProductRepositoryInterface::class => function (ContainerInterface $c) {
                return new ProductRepositoryBridge(
                    $c->get(Marketplace\Product\Business\Contract\ProductRepositoryInterface::class),
                    new \Marketplace\Product\Presentation\Component\Cart\Bridge\Mapper\ProductResponseMapper()
                );
            },
            \Marketplace\Cart\Business\Contract\CartRepositoryInterface::class => function (ContainerInterface $c) {
                return new \Marketplace\Cart\DataAccess\Repository\CartRepository();
            },
            CartServiceInterface::class => function (ContainerInterface $container) {
                return new CartService(

                    $container->get(\Marketplace\Cart\Business\Contract\CartRepositoryInterface::class),
                    $container->get(\Marketplace\Cart\Business\Contract\ProductRepositoryInterface::class)
                );
            },
            AddProductToCartAction::class => function (ContainerInterface $container) {
                return new AddProductToCartAction(
                    $container->get(CartServiceInterface::class),
                    new AddToCartRequestHandler(),
                    new AddToCartResponder(),
                    $container->get(LoggerInterface::class)
                );
            }
        ]
    );
};
