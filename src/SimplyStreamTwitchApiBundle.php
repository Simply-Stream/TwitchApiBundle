<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle;

use SimplyStream\TwitchApiBundle\DependencyInjection\SimplyStreamTwitchApiExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SimplyStreamTwitchApiBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new SimplyStreamTwitchApiExtension();
        }

        return $this->extension;
    }
}
