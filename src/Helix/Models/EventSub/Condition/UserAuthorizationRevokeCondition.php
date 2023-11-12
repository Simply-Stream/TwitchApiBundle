<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class UserAuthorizationRevokeCondition implements ConditionInterface
{
    use SerializesModels;

    public function __construct(
        private string $clientId
    ) {
    }

    public function getClientId(): string {
        return $this->clientId;
    }
}
