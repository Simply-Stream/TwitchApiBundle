<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class GoalsEvent extends Event
{
    /**
     * @param string             $id                    An ID that identifies this event.
     * @param string             $broadcasterUserId     An ID that uniquely identifies the broadcaster.
     * @param string             $broadcasterUserName   The broadcaster’s display name.
     * @param string             $broadcasterUserLogin  The broadcaster’s user handle.
     * @param string             $type                  The type of goal. Possible values are:
     *                                                  - follow — The goal is to increase followers.
     *                                                  - subscription — The goal is to increase subscriptions. This type shows the net
     *                                                  increase or decrease in tier points associated with the subscriptions.
     *                                                  - subscription_count — The goal is to increase subscriptions. This type shows the
     *                                                  net increase or decrease in the number of subscriptions.
     *                                                  - new_subscription — The goal is to increase subscriptions. This type shows only
     *                                                  the
     *                                                  net increase in tier points associated with the subscriptions (it does not account
     *                                                  for users that unsubscribed since the goal started).
     *                                                  - new_subscription_count — The goal is to increase subscriptions. This type shows
     *                                                  only the net increase in the number of subscriptions (it does not account for users
     *                                                  that unsubscribed since the goal started).
     * @param string             $description           A description of the goal, if specified. The description may contain a maximum of
     *                                                  40
     *                                                  characters.
     * @param bool               $isAchieved            A Boolean value that indicates whether the broadcaster achieved their goal. Is true
     *                                                  if the goal was achieved; otherwise, false. Only the channel.goal.end event
     *                                                  includes
     *                                                  this field.
     * @param int                $currentAmount         The goal’s current value.
     *                                                  The goal’s type determines how this value is increased or decreased.
     *                                                  - If type is follow, this field is set to the broadcaster's current number of
     *                                                  followers. This number increases with new followers and decreases when users
     *                                                  unfollow the broadcaster.
     *                                                  - If type is subscription, this field is increased and decreased by the points
     *                                                  value associated with the subscription tier. For example, if a tier-two
     *                                                  subscription is worth 2 points, this field is increased or decreased by 2, not 1.
     *                                                  - If type is subscription_count, this field is increased by 1 for each new
     *                                                  subscription and decreased by 1 for each user that unsubscribes.
     *                                                  - If type is new_subscription, this field is increased by the points value
     *                                                  associated with the subscription tier. For example, if a tier-two subscription is
     *                                                  worth 2 points, this field is increased by 2, not 1.
     *                                                  - If type is new_subscription_count, this field is increased by 1 for each new
     *                                                  subscription.
     * @param int                $targetAmount          The goal’s target value. For example, if the broadcaster has 200 followers before
     *                                                  creating the goal, and their goal is to double that number, this field is set to
     *                                                  400.
     * @param \DateTimeImmutable $startedAt             The UTC timestamp in RFC 3339 format, which indicates when the broadcaster created
     *                                                  the goal.
     * @param \DateTimeImmutable $endedAt               The UTC timestamp in RFC 3339 format, which indicates when the broadcaster ended
     *                                                  the goal. Only the channel.goal.end event includes this field.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserName,
        private string $broadcasterUserLogin,
        private string $type,
        private string $description,
        private bool $isAchieved,
        private int $currentAmount,
        private int $targetAmount,
        private \DateTimeImmutable $startedAt,
        private \DateTimeImmutable $endedAt
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function isAchieved(): bool {
        return $this->isAchieved;
    }

    public function getCurrentAmount(): int {
        return $this->currentAmount;
    }

    public function getTargetAmount(): int {
        return $this->targetAmount;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getEndedAt(): \DateTimeImmutable {
        return $this->endedAt;
    }
}
