<?php

    namespace AppBundle\DependencyInjection;

    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\Config\FileLocator;
    use Symfony\Component\HttpKernel\DependencyInjection\Extension;
    use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

    class Chgk_ckEventsExtension extends Extension
    {
        public function load(array $configs, ContainerBuilder $container)
        {
            $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . "/../../app/config"));
            $loader->load('services.yml');
        }
    }