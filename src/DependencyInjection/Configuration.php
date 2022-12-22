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
        $rootNode = $treeBuilder->getRootNode();
        //@formatter:off
        $rootNode
            ->children()
                ->scalarNode('http_client')
                    ->isRequired()
                    ->info('Service id of HTTP client to use (must implement \Psr\Http\Client\ClientInterface)')
                ->end()
                ->scalarNode('serializer')
                    ->isRequired()
                    ->info('Service id of HTTP client to use (must implement \JMS\Serializer\SerializerInterface)')
                ->end()
                ->scalarNode('request_factory')
                    ->isRequired()
                    ->info('Service id of Request factory to use (must implement \Psr\Http\Message\RequestFactoryInterface)')
                ->end()
                ->scalarNode('stream_factory')
                    ->isRequired()
                    ->info('Service id of Request factory to use (must implement \Psr\Http\Message\StreamFactoryInterface)')
                ->end()
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
