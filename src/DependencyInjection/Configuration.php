<?php declare(strict_types=1);

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
    public function getConfigTreeBuilder(): TreeBuilder {
        $treeBuilder = new TreeBuilder('simplystream_twitch_api');
        $rootNode = $treeBuilder->getRootNode();
        //@formatter:off
        $rootNode
            ->children()
                ->arrayNode('token')
                    ->children()
                        ->arrayNode('client_credentials')
                            ->children()
                                ->scalarNode('token')->end()
                                ->scalarNode('expires_in')->end()
                                ->scalarNode('token_type')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('twitch_id')->isRequired()->end()
                ->scalarNode('twitch_secret')->end()
                ->scalarNode('redirect_uri')->end()
                ->arrayNode('scopes')
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('webhook')
                    ->children()
                        ->scalarNode('secret')->end()
                    ->end()
                ->end()
            ->end()
        ;
        //@formatter:on

        return $treeBuilder;
    }
}
