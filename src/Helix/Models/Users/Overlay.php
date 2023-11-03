<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

final readonly class Overlay
{
    /**
     * @param bool   $active  A Boolean value that determines the extension’s activation state. If false, the user has not configured this
     *                        overlay extension.
     * @param string $id      An ID that identifies the extension.
     * @param string $version The extension’s version.
     * @param string $name    The extension’s name.
     */
    public function __construct(
        private bool $active,
        private string $id,
        private string $version,
        private string $name
    ) {
    }

    public function isActive(): bool {
        return $this->active;
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
}
