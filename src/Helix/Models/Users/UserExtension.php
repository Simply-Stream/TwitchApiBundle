<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

final readonly class UserExtension
{
    /**
     * @param string   $id        An ID that identifies the extension.
     * @param string   $version   The extension’s version.
     * @param string   $name      The extension’s name.
     * @param bool     $canActive A Boolean value that determines whether the extension is configured and can be activated. Is true if the
     *                            extension is configured and can be activated.
     * @param string[] $type      The extension types that you can activate for this extension. Possible values are:
     *                            - component
     *                            - mobile
     *                            - overlay
     *                            - panel
     */
    public function __construct(
        private string $id,
        private string $version,
        private string $name,
        private bool $canActive,
        private array $type
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getName(): string {
        return $this->name;
    }

    public function isCanActive(): bool {
        return $this->canActive;
    }

    public function getType(): array {
        return $this->type;
    }
}
