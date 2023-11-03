<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

use Webmozart\Assert\Assert;

final readonly class SetExtensionConfigurationSegmentRequest
{
    /**
     * @param string      $extensionId   The ID of the extension to update.
     * @param string      $segment       The configuration segment to update. Possible case-sensitive values are:
     *                                   - broadcaster
     *                                   - developer
     *                                   - global
     * @param string|null $broadcasterId The ID of the broadcaster that installed the extension. Include this field only if the segment is
     *                                   set to developer or broadcaster.
     * @param string|null $content       The contents of the segment. This string may be a plain-text string or a string-encoded JSON
     *                                   object.
     * @param string|null $version       The version number that identifies this definition of the segment’s data. If not specified, the
     *                                   latest definition is updated.
     */
    public function __construct(
        private string $extensionId,
        private string $segment,
        private ?string $broadcasterId = null,
        private ?string $content = null,
        private ?string $version = null
    ) {
        Assert::stringNotEmpty($this->extensionId, 'Extension id can\'t be empty');
        Assert::inArray($this->segment, ['broadcaster', 'developer', 'global'], 'Segment got an invalid value. Allowed values: broadcaster, developer, global');
    }

    public function getExtensionId(): string {
        return $this->extensionId;
    }

    public function getSegment(): string {
        return $this->segment;
    }

    public function getBroadcasterId(): ?string {
        return $this->broadcasterId;
    }

    public function getContent(): ?string {
        return $this->content;
    }

    public function getVersion(): ?string {
        return $this->version;
    }
}
