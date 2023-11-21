<?php
declare(strict_types=1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\DependencyInjection;

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

        // This is deprecated and will be replaced by https://github.com/vertisan/oauth2-twitch-helix
        $twitchProviderDefinition = $container->getDefinition(
            'simplystream.twitch_api.helix_authentication_provider.twitch_provider'
        );
        $twitchProviderDefinition->setArgument(0, [
            'clientId' => $config['twitch_id'],
            'clientSecret' => $config['twitch_secret'] ?? null,
            'urlAuthorize' => 'https://id.twitch.tv/oauth2/authorize',
            'urlAccessToken' => 'https://id.twitch.tv/oauth2/token',
            'urlResourceOwnerDetails' => 'https://id.twitch.tv/oauth2/userinfo',
            'redirectUri' => $config['redirect_uri'] ?? [],
            'scopes' => $config['scopes'] ?? [],
        ]);

        $eventServiceDefinition = $container->getDefinition('simplystream.twitch_api.helix.event_sub_service');
        $eventServiceDefinition->setArgument(2, [
            'clientId' => $config['twitch_id'],
            'webhook' => ['secret' => $config['webhook']['secret'] ?? null],
        ]);

        $apiServiceDefinition = $container->getDefinition('simplystream.twitch_api.helix_api.api_client');
        $apiServiceDefinition->setArgument(5, [
            'clientId' => $config['twitch_id'],
            'webhook' => ['secret' => $config['webhook']['secret'] ?? null],
        ]);
        $container->setDefinition('simplystream.twitch_api.helix_api.api_client', $apiServiceDefinition);

        $apiClientDefinition = $container->getDefinition('simplystream.twitch_api.helix_api.api_client');

        $apiClientOptions = [
            'clientId' => $config['twitch_id'],
        ];

        if (isset($config['token']['client_credentials'])) {
            $apiClientOptions['token'] = [
                'client_credentials' => [
                    'token' => $config['token']['client_credentials']['token'],
                    'expires_in' => $config['token']['client_credentials']['expires_in'],
                    'token_type' => $config['token']['client_credentials']['token_type'],
                ],
            ];
        }

        $apiClientDefinition->setArgument('$options', [
            'clientId' => $config['twitch_id']
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
