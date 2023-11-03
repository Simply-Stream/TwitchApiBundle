<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

final readonly class UserActiveExtension
{
    /**
     * @param Panel[]     $panel     A dictionary that contains the data for a panel extension. The dictionary’s key is a sequential number
     *                               beginning with 1. The following fields contain the panel’s data for each key.
     * @param Overlay[]   $overlay   A dictionary that contains the data for a video-overlay extension. The dictionary’s key is a
     *                               sequential number beginning with 1. The following fields contain the overlay’s data for each key.
     * @param Component[] $component A dictionary that contains the data for a video-component extension. The dictionary’s key is a
     *                               sequential number beginning with 1. The following fields contain the component’s data for each key.
     */
    public function __construct(
        private array $panel,
        private array $overlay,
        private array $component
    ) {
    }

    public function getPanel(): array {
        return $this->panel;
    }

    public function getOverlay(): array {
        return $this->overlay;
    }

    public function getComponent(): array {
        return $this->component;
    }
}
