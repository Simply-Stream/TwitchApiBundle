<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

final readonly class Component
{
    /**
     * @param bool        $active  A Boolean value that determines the extension’s activation state. If false, the user has not configured
     *                             this component extension.
     * @param string|null $id      An ID that identifies the extension.
     * @param string|null $version The extension’s version.
     * @param string|null $name    The extension’s name.
     * @param int|null    $x       The x-coordinate where the extension is placed.
     * @param int|null    $y       The y-coordinate where the extension is placed.
     */
    public function __construct(
        private bool $active,
        private ?string $id = null,
        private ?string $version = null,
        private ?string $name = null,
        private ?int $x = null,
        private ?int $y = null,
    ) {
    }

    public function isActive(): bool {
        return $this->active;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function getVersion(): ?string {
        return $this->version;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getX(): ?int {
        return $this->x;
    }

    public function getY(): ?int {
        return $this->y;
    }
}
