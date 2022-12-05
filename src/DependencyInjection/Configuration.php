<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('simplystream_twitch_api');
        //@formatter:off
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->scalarNode('twitch_id')->isRequired()->end()
                ->scalarNode('twitch_secret')->isRequired()->end()
                ->scalarNode('redirect_uri')->isRequired()->end()
                ->arrayNode('scopes')
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('webhook')
                    ->children()
                        ->scalarNode('secret')->isRequired()->end()
                    ->end()
                ->end()
            ->end()
        ;
        //@formatter:on

        return $treeBuilder;
    }
}
