<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

final readonly class Extension
{
    /**
     * @param string   $authorName                The name of the user or organization that owns the extension.
     * @param bool     $bitsEnabled               A Boolean value that determines whether the extension has features that use Bits. Is true
     *                                            if the extension has features that use Bits.
     * @param bool     $canInstall                A Boolean value that determines whether a user can install the extension on their
     *                                            channel. Is true if a user can install the extension.
     *
     *                                            Typically, this is set to false if the extension is currently in testing mode and
     *                                            requires users to be allowlisted (the allowlist is configured on Twitch’s developer site
     *                                            under the Extensions -> Extension -> Version -> Access).
     * @param string   $configurationLocation     The location of where the extension’s configuration is stored. Possible values are:
     *                                            - hosted — The Extensions Configuration Service hosts the configuration.
     *                                            - custom — The Extension Backend Service (EBS) hosts the configuration.
     *                                            - none — The extension doesn't require configuration.
     * @param string   $description               A longer description of the extension. It appears on the details page.
     * @param string   $eulaTosUrl                A URL to the extension’s Terms of Service.
     * @param bool     $hasChatSupport            A Boolean value that determines whether the extension can communicate with the installed
     *                                            channel’s chat. Is true if the extension can communicate with the channel’s chat room.
     * @param string   $iconUrl                   A URL to the default icon that’s displayed in the Extensions directory.
     * @param string[] $iconUrls                  A dictionary that contains URLs to different sizes of the default icon. The dictionary’s
     *                                            key identifies the icon’s size (for example, 24x24), and the dictionary’s value contains
     *                                            the URL to the icon.
     * @param string   $id                        The extension’s ID.
     * @param string   $name                      The extension’s name.
     * @param string   $privacyPolicyUrl          A URL to the extension’s privacy policy.
     * @param bool     $requestIdentityLink       A Boolean value that determines whether the extension wants to explicitly ask viewers to
     *                                            link their Twitch identity.
     * @param string[] $screenshotUrls            A list of URLs to screenshots that are shown in the Extensions marketplace.
     * @param string   $state                     The extension’s state. Possible values are:
     *                                            - Approved
     *                                            - AssetsUploaded
     *                                            - Deleted
     *                                            - Deprecated
     *                                            - InReview
     *                                            - InTest
     *                                            - PendingAction
     *                                            - Rejected
     *                                            - Released
     * @param string   $subscriptionsSupportLevel Indicates whether the extension can view the user’s subscription level on the channel
     *                                            that the extension is installed on. Possible values are:
     *                                            - none — The extension can't view the user’s subscription level.
     *                                            - optional — The extension can view the user’s subscription level.
     * @param string   $summary                   A short description of the extension that streamers see when hovering over the discovery
     *                                            splash screen in the Extensions manager.
     * @param string   $supportEmail              The email address that users use to get support for the extension.
     * @param string   $version                   The extension’s version number.
     * @param string   $viewerSummary             A brief description displayed on the channel to explain how the extension works.
     * @param array    $views                     Describes all views-related information such as how the extension is displayed on mobile
     *                                            devices.
     * @param string[] $allowlistedConfigUrls     Allowlisted configuration URLs for displaying the extension (the allowlist is configured
     *                                            on Twitch’s developer site under the Extensions -> Extension -> Version -> Capabilities).
     * @param string[] $allowlistedPanelUrls      Allowlisted panel URLs for displaying the extension (the allowlist is configured on
     *                                            Twitch’s developer site under the Extensions -> Extension -> Version -> Capabilities).
     */
    public function __construct(
        private string $authorName,
        private bool $bitsEnabled,
        private bool $canInstall,
        private string $configurationLocation,
        private string $description,
        private string $eulaTosUrl,
        private bool $hasChatSupport,
        private string $iconUrl,
        private array $iconUrls,
        private string $id,
        private string $name,
        private string $privacyPolicyUrl,
        private bool $requestIdentityLink,
        private array $screenshotUrls,
        private string $state,
        private string $subscriptionsSupportLevel,
        private string $summary,
        private string $supportEmail,
        private string $version,
        private string $viewerSummary,
        private array $views,
        private array $allowlistedConfigUrls,
        private array $allowlistedPanelUrls
    ) {
    }

    public function getAuthorName(): string {
        return $this->authorName;
    }

    public function isBitsEnabled(): bool {
        return $this->bitsEnabled;
    }

    public function isCanInstall(): bool {
        return $this->canInstall;
    }

    public function getConfigurationLocation(): string {
        return $this->configurationLocation;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getEulaTosUrl(): string {
        return $this->eulaTosUrl;
    }

    public function isHasChatSupport(): bool {
        return $this->hasChatSupport;
    }

    public function getIconUrl(): string {
        return $this->iconUrl;
    }

    public function getIconUrls(): array {
        return $this->iconUrls;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrivacyPolicyUrl(): string {
        return $this->privacyPolicyUrl;
    }

    public function isRequestIdentityLink(): bool {
        return $this->requestIdentityLink;
    }

    public function getScreenshotUrls(): array {
        return $this->screenshotUrls;
    }

    public function getState(): string {
        return $this->state;
    }

    public function getSubscriptionsSupportLevel(): string {
        return $this->subscriptionsSupportLevel;
    }

    public function getSummary(): string {
        return $this->summary;
    }

    public function getSupportEmail(): string {
        return $this->supportEmail;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getViewerSummary(): string {
        return $this->viewerSummary;
    }

    public function getViews(): array {
        return $this->views;
    }

    public function getAllowlistedConfigUrls(): array {
        return $this->allowlistedConfigUrls;
    }

    public function getAllowlistedPanelUrls(): array {
        return $this->allowlistedPanelUrls;
    }
}
