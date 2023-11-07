<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

/**
 * (BETA) Channel Ad Break Begin
 * A midroll commercial break has started running.
 */
final readonly class ChannelAdBreakBeginCondition implements ConditionInterface
{
    public const TYPE = 'channel.ad_break.begin	';

    public function __construct(
        private string $broadcasterId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }
}
