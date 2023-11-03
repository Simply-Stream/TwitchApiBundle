<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

final readonly class Component
{
    /**
     * @param bool   $active  A Boolean value that determines the extension’s activation state. If false, the user has not configured this
     *                        component extension.
     * @param string $id      An ID that identifies the extension.
     * @param string $version The extension’s version.
     * @param string $name    The extension’s name.
     * @param int    $x       The x-coordinate where the extension is placed.
     * @param int    $y       The y-coordinate where the extension is placed.
     */
    public function __construct(
        private bool $active,
        private string $id,
        private string $version,
        private string $name,
        private int $x,
        private int $y
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

    public function getX(): int {
        return $this->x;
    }

    public function getY(): int {
        return $this->y;
    }
}
