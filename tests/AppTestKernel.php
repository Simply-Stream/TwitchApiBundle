<?php

namespace SimplyStream\TwitchApiBundle\Tests;

use SimplyStream\TwitchApiBundle\SimplyStreamTwitchApiBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppTestKernel extends Kernel
{

    public function registerBundles(): iterable {
        $bundles = [];

        if ($this->getEnvironment() === 'test') {
            $bundles[] = new FrameworkBundle();
            $bundles[] = new SimplyStreamTwitchApiBundle();
        }

        return $bundles;
    }

    /**
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config_' . $this->getEnvironment() . '.yaml');
    }
}
