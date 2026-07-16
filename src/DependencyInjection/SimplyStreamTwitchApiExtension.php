<?php

declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\DependencyInjection;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use SimplyStream\TwitchApi\EventSub\Attributes\EventSubSubscription;
use SimplyStream\TwitchApi\EventSub\EventSubMessageProcessor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

final class SimplyStreamTwitchApiExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.php');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $apiClient = $container->getDefinition('simplystream.twitch_api.helix_api.api_client');
        $apiClient->setArgument('$clientId', $config['client_id']);

        if (null !== $config['base_url']) {
            $apiClient->setArgument('$baseUrl', $config['base_url']);
        }

        $this->configureEventSub($container, $config['event_sub'] ?? []);
    }

    /**
     * @param array<string, mixed> $config
     */
    private function configureEventSub(ContainerBuilder $container, array $config): void
    {
        // Without a secret there is nothing to verify signatures against, so the pipeline stays
        // unregistered rather than failing at runtime on the first webhook.
        if (empty($config['webhook_secret'])) {
            foreach ($container->getDefinitions() as $id => $definition) {
                if (str_starts_with($id, 'simplystream.twitch_api.event_sub.')) {
                    $container->removeDefinition($id);
                }
            }

            $container->removeAlias(EventSubMessageProcessor::class);

            return;
        }

        if (null !== ($config['freshness_tolerance_seconds'] ?? null)) {
            $container->getDefinition('simplystream.twitch_api.event_sub.freshness_validator')
                ->setArgument('$toleranceSeconds', $config['freshness_tolerance_seconds']);
        }

        $container->getDefinition('simplystream.twitch_api.event_sub.signature_verifier')
            ->setArgument(0, $config['webhook_secret']);

        $eventClasses = $config['event_classes'] ?? [];

        // The scan runs once here, at compile time; the resulting list is baked into the
        // compiled container as a literal array.
        if ([] === $eventClasses) {
            $eventClasses = $this->discoverEventClasses();
        }

        $container->getDefinition('simplystream.twitch_api.event_sub.registry')
            ->setArgument(0, $eventClasses);

        if (null !== ($config['processed_message_store'] ?? null)) {
            $container->setAlias(
                'simplystream.twitch_api.event_sub.processed_message_store',
                $config['processed_message_store'],
            );
        }

        if (null !== ($config['clock'] ?? null)) {
            $container->setAlias('simplystream.twitch_api.event_sub.clock', $config['clock']);
        }
    }

    /**
     * @return list<class-string>
     */
    private function discoverEventClasses(): array
    {
        $reflection = new ReflectionClass(EventSubMessageProcessor::class);
        $root = \dirname($reflection->getFileName()) . '/Events';

        $base = 'SimplyStream\\TwitchApi\\EventSub\\Events\\';
        $classes = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
        );

        foreach ($iterator as $file) {
            if ('php' !== $file->getExtension()) {
                continue;
            }

            $relative = substr($file->getPathname(), \strlen($root) + 1, -4);
            $class = $base . str_replace('/', '\\', $relative);

            if (!class_exists($class)) {
                continue;
            }

            // Sub-models live in the same tree but carry no attribute.
            if ([] === (new ReflectionClass($class))->getAttributes(EventSubSubscription::class)) {
                continue;
            }

            $classes[] = $class;
        }

        sort($classes);

        return $classes;
    }
}
