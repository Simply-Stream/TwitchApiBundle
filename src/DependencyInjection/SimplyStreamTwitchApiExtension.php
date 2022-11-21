<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\DependencyInjection;

use SimplyStream\TwitchApiBundle\Helix\Api\TwitchApiService;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\EventSub\EventSubService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class SimplyStreamTwitchApiExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('oauth.xml');
        $loader->load('api.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $twitchProviderDefinition = $container->getDefinition(TwitchProvider::class);
        $twitchProviderDefinition->setArgument(0, [
            'clientId' => $config['twitch_id'],
            'clientSecret' => $config['twitch_secret'],
            'urlAuthorize' => 'https://id.twitch.tv/oauth2/authorize',
            'urlAccessToken' => 'https://id.twitch.tv/oauth2/token',
            'urlResourceOwnerDetails' => 'https://id.twitch.tv/oauth2/userinfo',
            'redirectUri' => $config['redirect_uri'],
            'scopes' => $config['scopes'],
        ]);

        $eventServiceDefinition = $container->getDefinition(EventSubService::class);
        $eventServiceDefinition->setArgument(5,
            ['clientId' => $config['twitch_id'], 'webhook' => ['secret' => $config['webhook']['secret']]]);

        $twitchApiServiceDefinition = $container->getDefinition(TwitchApiService::class);
        $twitchApiServiceDefinition->setArgument(5, [
            'clientId' => $config['twitch_id'],
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias(): string
    {
        return 'simplystream_twitch_api';
    }
}
