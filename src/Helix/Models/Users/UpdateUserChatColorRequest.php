<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Users;

final readonly class UpdateUserChatColorRequest
{
    /**
     * @param string $userId The ID of the user whose chat color you want to update. This ID must match the user ID in the access token.
     * @param string $color  The color to use for the user’s name in chat. All users may specify one of the following named color values.
     *                       - blue
     *                       - blue_violet
     *                       - cadet_blue
     *                       - chocolate
     *                       - coral
     *                       - dodger_blue
     *                       - firebrick
     *                       - golden_rod
     *                       - green
     *                       - hot_pink
     *                       - orange_red
     *                       - red
     *                       - sea_green
     *                       - spring_green
     *                       - yellow_green
     *                       Turbo and Prime users may specify a named color or a Hex color code like #9146FF. If you use a Hex color code,
     *                       remember to URL encode it.
     */
    public function __construct(
        private string $userId,
        private string $color
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getColor(): string {
        return $this->color;
    }
}
