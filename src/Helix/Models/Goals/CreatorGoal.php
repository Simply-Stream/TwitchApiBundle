<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Goals;

final readonly class CreatorGoal
{
    /**
     * @param string             $id               An ID that identifies this goal.
     * @param string             $broadcasterId    An ID that identifies the broadcaster that created the goal.
     * @param string             $broadcasterName  The broadcaster’s display name.
     * @param string             $broadcasterLogin The broadcaster’s login name.
     * @param string             $type             The type of goal. Possible values are:
     *                                             - follower — The goal is to increase followers.
     *                                             - subscription — The goal is to increase subscriptions. This type shows the net increase
     *                                             or decrease in tier points associated with the subscriptions.
     *                                             - subscription_count — The goal is to increase subscriptions. This type shows the net
     *                                             increase or decrease in the number of subscriptions.
     *                                             - new_subscription — The goal is to increase subscriptions. This type shows only the net
     *                                             increase in tier points associated with the subscriptions (it does not account for users
     *                                             that unsubscribed since the goal started).
     *                                             - new_subscription_count — The goal is to increase subscriptions. This type shows only
     *                                             the net increase in the number of subscriptions (it does not account for users that
     *                                             unsubscribed since the goal started).
     * @param string             $description      A description of the goal. Is an empty string if not specified.
     * @param int                $currentAmount    The goal’s current value.
     *
     *                                             The goal’s type determines how this value is increased or decreased.
     *                                             - If type is follower, this field is set to the broadcaster's current number of
     *                                             followers. This number increases with new followers and decreases when users unfollow
     *                                             the broadcaster.
     *                                             - If type is subscription, this field is increased and decreased by the points value
     *                                             associated with the subscription tier. For example, if a tier-two subscription is worth 2
     *                                             points, this field is increased or decreased by 2, not 1.
     *                                             - If type is subscription_count, this field is increased by 1 for each new subscription
     *                                             and decreased by 1 for each user that unsubscribes.
     *                                             - If type is new_subscription, this field is increased by the points value associated
     *                                             with the subscription tier. For example, if a tier-two subscription is worth 2 points,
     *                                             this field is increased by 2, not 1.
     *                                             - If type is new_subscription_count, this field is increased by 1 for each new
     *                                             subscription.
     * @param int                $targetAmount     The goal’s target value. For example, if the broadcaster has 200 followers before
     *                                             creating the goal, and their goal is to double that number, this field is set to 400.
     * @param \DateTimeImmutable $createdAt        The UTC date and time (in RFC3339 format) that the broadcaster created the goal.
     */
    public function __construct(
        private string $id,
        private string $broadcasterId,
        private string $broadcasterName,
        private string $broadcasterLogin,
        private string $type,
        private string $description,
        private int $currentAmount,
        private int $targetAmount,
        private \DateTimeImmutable $createdAt
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCurrentAmount(): int {
        return $this->currentAmount;
    }

    public function getTargetAmount(): int {
        return $this->targetAmount;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }
}
