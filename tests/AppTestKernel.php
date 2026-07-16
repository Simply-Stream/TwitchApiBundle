<?php

namespace SimplyStream\TwitchApiBundle\Tests;

use SimplyStream\TwitchApiBundle\SimplyStreamTwitchApiBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppTestKernel extends Kernel
{

    public function registerBundles(): iterable {
        return [
            new FrameworkBundle(),
            new SimplyStreamTwitchApiBundle(),
        ];
    }

    /**
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config_' . $this->getEnvironment() . '.yaml');
    }
}
