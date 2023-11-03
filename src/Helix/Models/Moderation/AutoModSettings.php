<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Moderation;

final readonly class AutoModSettings
{
    /**
     * @param string $broadcasterId           The broadcaster’s ID.
     * @param string $moderatorId             The moderator’s ID.
     * @param int    $overallLevel            The default AutoMod level for the broadcaster. This field is null if the broadcaster has set
     *                                        one or more of the individual settings.
     * @param int    $disability              The Automod level for discrimination against disability.
     * @param int    $aggression              The Automod level for hostility involving aggression.
     * @param int    $sexualitySexOrGender    The AutoMod level for discrimination based on sexuality, sex, or gender.
     * @param int    $misogyny                The Automod level for discrimination against women.
     * @param int    $bullying                The Automod level for hostility involving name calling or insults.
     * @param int    $swearing                The Automod level for profanity.
     * @param int    $raceEthnicityOrReligion The Automod level for racial discrimination.
     * @param int    $sexBasedTerms           The Automod level for sexual content.
     */
    public function __construct(
        private string $broadcasterId,
        private string $moderatorId,
        private int $overallLevel,
        private int $disability,
        private int $aggression,
        private int $sexualitySexOrGender,
        private int $misogyny,
        private int $bullying,
        private int $swearing,
        private int $raceEthnicityOrReligion,
        private int $sexBasedTerms
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getModeratorId(): string {
        return $this->moderatorId;
    }

    public function getOverallLevel(): int {
        return $this->overallLevel;
    }

    public function getDisability(): int {
        return $this->disability;
    }

    public function getAggression(): int {
        return $this->aggression;
    }

    public function getSexualitySexOrGender(): int {
        return $this->sexualitySexOrGender;
    }

    public function getMisogyny(): int {
        return $this->misogyny;
    }

    public function getBullying(): int {
        return $this->bullying;
    }

    public function getSwearing(): int {
        return $this->swearing;
    }

    public function getRaceEthnicityOrReligion(): int {
        return $this->raceEthnicityOrReligion;
    }

    public function getSexBasedTerms(): int {
        return $this->sexBasedTerms;
    }
}
