<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Moderation;

use Webmozart\Assert\Assert;

final readonly class UpdateAutoModSettingsRequest
{
    /**
     * Because PUT is an overwrite operation, you must include all the fields that you want set after the operation completes. Typically,
     * you’ll send a GET request, update the fields you want to change, and pass that object in the PUT request.
     *
     * You may set either overall_level or the individual settings like aggression, but not both.
     *
     * Setting overall_level applies default values to the individual settings. However, setting overall_level to 4 does not necessarily
     * mean that it applies 4 to all the individual settings. Instead, it applies a set of recommended defaults to the rest of the
     * settings. For example, if you set overall_level to 2, Twitch provides some filtering on discrimination and sexual content, but more
     * filtering on hostility (see the first example response).
     *
     * If overall_level is currently set and you update swearing to 3, overall_level will be set to null and all settings other than
     * swearing will be set to 0. The same is true if individual settings are set and you update overall_level to 3 — all the individual
     * settings are updated to reflect the default level.
     *
     * Note that if you set all the individual settings to values that match what overall_level would have set them to, Twitch changes
     * AutoMod to use the default AutoMod level instead of using the individual settings.
     *
     * Valid values for all levels are from 0 (no filtering) through 4 (most aggressive filtering). These levels affect how aggressively
     * AutoMod holds back messages for moderators to review before they appear in chat or are denied (not shown).
     *
     * @param int $aggression              The Automod level for hostility involving aggression.
     * @param int $bullying                The Automod level for hostility involving name calling or insults.
     * @param int $disability              The Automod level for discrimination against disability.
     * @param int $misogyny                The Automod level for discrimination against women.
     * @param int $raceEthnicityOrReligion The Automod level for racial discrimination.
     * @param int $sexBasedTerms           The Automod level for sexual content.
     * @param int $sexualitySexOrGender    The AutoMod level for discrimination based on sexuality, sex, or gender.
     * @param int $swearing                The Automod level for profanity.
     * @param int $overallLevel            The default AutoMod level for the broadcaster.
     */
    public function __construct(
        private int $aggression,
        private int $bullying,
        private int $disability,
        private int $misogyny,
        private int $raceEthnicityOrReligion,
        private int $sexBasedTerms,
        private int $sexualitySexOrGender,
        private int $swearing,
        private int $overallLevel
    ) {
        Assert::allGreaterThanEq([
            $this->aggression,
            $this->bullying,
            $this->disability,
            $this->misogyny,
            $this->raceEthnicityOrReligion,
            $this->sexBasedTerms,
            $this->sexualitySexOrGender,
            $this->swearing,
            $this->overallLevel,
        ], 0, 'Minimum value for individual level is 0');

        Assert::allLessThanEq([
            $this->aggression,
            $this->bullying,
            $this->disability,
            $this->misogyny,
            $this->raceEthnicityOrReligion,
            $this->sexBasedTerms,
            $this->sexualitySexOrGender,
            $this->swearing,
            $this->overallLevel,
        ], 4, 'Maximum value for each individual level is 4');
    }

    public function getAggression(): int {
        return $this->aggression;
    }

    public function getBullying(): int {
        return $this->bullying;
    }

    public function getDisability(): int {
        return $this->disability;
    }

    public function getMisogyny(): int {
        return $this->misogyny;
    }

    public function getOverallLevel(): int {
        return $this->overallLevel;
    }

    public function getRaceEthnicityOrReligion(): int {
        return $this->raceEthnicityOrReligion;
    }

    public function getSexBasedTerms(): int {
        return $this->sexBasedTerms;
    }

    public function getSexualitySexOrGender(): int {
        return $this->sexualitySexOrGender;
    }

    public function getSwearing(): int {
        return $this->swearing;
    }
}
