<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

use SimplyStream\TwitchApiBundle\Helix\Models\AbstractModel;

final readonly class UpdateUserExtension extends AbstractModel
{
    /**
     * @param array $data The extensions to update. The data field is a dictionary of extension types. The dictionary’s possible keys are:
     *                    panel, overlay, or component. The key’s value is a dictionary of extensions.
     *
     *                    For the extension’s dictionary, the key is a sequential number beginning with 1. For panel and overlay
     *                    extensions, the key’s value is an object that contains the following fields: active (true/false), id (the
     *                    extension’s ID), and version (the extension’s version).
     *
     *                    For component extensions, the key’s value includes the above fields plus the x and y fields, which identify the
     *                    coordinate where the extension is placed.
     */
    public function __construct(
        private array $data
    ) {
    }

    public function getData(): array {
        return $this->data;
    }
}
