<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class ExtensionBitsTransactionCreateCondition implements ConditionInterface
{
    public const TYPE = 'extension.bits_transaction.create';

    public function __construct(
        private string $extensionClientId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getExtensionClientId(): string {
        return $this->extensionClientId;
    }
}
