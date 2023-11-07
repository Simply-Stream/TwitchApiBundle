<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

final readonly class User
{
    /**
     * @param string             $id              An ID that identifies the user.
     * @param string             $login           The user’s login name.
     * @param string             $displayName     The user’s display name.
     * @param string             $type            The type of user. Possible values are:
     *                                            - admin — Twitch administrator
     *                                            - global_mod
     *                                            - staff — Twitch staff
     *                                            - "" — Normal user
     * @param string             $broadcasterType The type of broadcaster. Possible values are:
     *                                            - affiliate — An affiliate broadcaster
     *                                            - partner — A partner broadcaster
     *                                            - "" — A normal broadcaster
     * @param string             $description     The user’s description of their channel.
     * @param string             $profileImageUrl A URL to the user’s profile image.
     * @param string             $offlineImageUrl A URL to the user’s offline image.
     * @param int                $viewCount       The number of times the user’s channel has been viewed.
     *
     *                                            NOTE: This field has been deprecated (see Get Users API endpoint – “view_count”
     *                                            deprecation). Any data in this field is not valid and should not be used.
     * @param \DateTimeImmutable $createdAt       The UTC date and time that the user’s account was created. The timestamp is in RFC3339
     *                                            format.
     * @param string|null        $email           The user’s verified email address. The object includes this field only if the user access
     *                                            token includes the user:read:email scope.
     *
     *                                            If the request contains more than one user, only the user associated with the access
     *                                            token that provided consent will include an email address — the email address for all
     *                                            other users will be empty.
     */
    public function __construct(
        private string $id,
        private string $login,
        private string $displayName,
        private string $type,
        private string $broadcasterType,
        private string $description,
        private string $profileImageUrl,
        private string $offlineImageUrl,
        private int $viewCount,
        private \DateTimeImmutable $createdAt,
        private ?string $email = null
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getDisplayName(): string {
        return $this->displayName;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getBroadcasterType(): string {
        return $this->broadcasterType;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getProfileImageUrl(): string {
        return $this->profileImageUrl;
    }

    public function getOfflineImageUrl(): string {
        return $this->offlineImageUrl;
    }

    public function getViewCount(): int {
        return $this->viewCount;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }
}
