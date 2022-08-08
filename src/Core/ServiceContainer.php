<?php

declare(strict_types=1);

namespace App\Core;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ServiceContainer extends ContainerBuilder
{
    public static function buildContainer(): self
    {
        $container = new self();
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(sprintf('%s/../../config', __DIR__))
        );
        $loader->load('services.yaml');
        $container->compile(true);

        return $container;
    }
}