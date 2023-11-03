<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

use Webmozart\Assert\Assert;

final readonly class SetExtensionRequiredConfigurationRequest
{
    /**
     * @param string $extensionId           The ID of the extension to update.
     * @param string $extensionVersion      The version of the extension to update.
     * @param string $requiredConfiguration The required_configuration string to use with the extension.
     */
    public function __construct(
        private string $extensionId,
        private string $extensionVersion,
        private string $requiredConfiguration
    ) {
        Assert::stringNotEmpty($this->extensionId, 'Extension ID can\'t be empty');
        Assert::stringNotEmpty($this->extensionVersion, 'Extension version can\'t be empty');
        Assert::stringNotEmpty($this->requiredConfiguration, 'Required configuration can\'t be empty');
    }

    public function getExtensionId(): string {
        return $this->extensionId;
    }

    public function getExtensionVersion(): string {
        return $this->extensionVersion;
    }

    public function getRequiredConfiguration(): string {
        return $this->requiredConfiguration;
    }
}
