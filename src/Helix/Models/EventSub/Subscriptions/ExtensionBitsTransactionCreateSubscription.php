<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ExtensionBitsTransactionCreateCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * A broadcaster updates their channel properties e.g., category, title, content classification labels, broadcast, or language.
 */
final readonly class ExtensionBitsTransactionCreateSubscription extends Subscription
{
    public const TYPE = 'extension.bits_transaction.create';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "1"
    ) {
        parent::__construct($type, $version, new ExtensionBitsTransactionCreateCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
