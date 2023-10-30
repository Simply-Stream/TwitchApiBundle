<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\DependencyInjection;

use SimplyStream\TwitchApiBundle\Helix\Api\ApiClient;
use SimplyStream\TwitchApiBundle\Helix\EventSub\EventSubService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

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

        // @TODO: Check if this class is still needed, now that KnpU has a helix provider
        $twitchProviderDefinition = $container->getDefinition('simplystream_twitch_api.helix_authentication_provider.twitch_provider');
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
        $eventServiceDefinition->setArgument(3, [
            'clientId' => $config['twitch_id'],
            'webhook' => ['secret' => $config['webhook']['secret']],
        ]);

        $apiClient = $container->register(
            'simplystream_twitch_api.helix_api.api_client',
            ApiClient::class
        );
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

        $apiClient->setArguments([
            new Reference($config['http_client']),
            $container->getDefinition('simplystream_twitch_api.helix_authentication_provider.twitch_provider'),
            new Reference('CuyZ\Valinor\Mapper\TreeMapper'),
            $apiClientOptions,
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
