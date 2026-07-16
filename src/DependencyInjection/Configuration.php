<?php

/*
 * MIT License
 *
 * Copyright (c) 2021 TobiDev (simply-stream.com)
 */

declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAlias(): string
    {
        return 'simplystream_twitch_api';
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('simplystream_twitch_api');

        //@formatter:off
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('client_id')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('Your application\'s client ID, sent as the Client-Id header on every request.')
                ->end()
                ->scalarNode('base_url')
                    ->defaultNull()
                    ->info('Override the Helix base URL, for example to point at the Twitch CLI\'s mock API.')
                ->end()
            ->arrayNode('event_sub')
                ->info('Only needed if you receive EventSub webhooks.')
                ->children()
                    ->scalarNode('webhook_secret')
                        ->defaultNull()
                        ->info('The secret you passed to Twitch when creating the subscription. Required to verify incoming webhook signatures.')
                    ->end()
                    ->integerNode('freshness_tolerance_seconds')
                        ->defaultNull()
                        ->min(1)
                        ->info('How far a message timestamp may deviate from now before it is rejected. Defaults to the library\'s 600 seconds.')
                    ->end()
                    ->scalarNode('processed_message_store')
                        ->defaultNull()
                        ->info('Service ID of a ProcessedMessageStoreInterface implementation. Defaults to an in-memory store, which does NOT deduplicate across requests — see the README.')
                    ->end()
                    ->scalarNode('clock')
                        ->defaultNull()
                        ->info('Service ID of a ClockInterface implementation. Defaults to the system clock.')
                    ->end()
                    ->arrayNode('event_classes')
                        ->scalarPrototype()->end()
                        ->info('Fully qualified event class names to register. Defaults to every event class shipped with the library.')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();
        //@formatter:on

        return $treeBuilder;
    }
}
