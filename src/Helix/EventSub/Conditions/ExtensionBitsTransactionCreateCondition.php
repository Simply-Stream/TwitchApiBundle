<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions
 */
class ExtensionBitsTransactionCreateCondition extends AbstractCondition
{
    public const TYPE = 'extension.bits_transaction.create';

    protected $requiredOptions = [
        'extensionClientId',
    ];

    /**
     * @var string
     */
    protected $extensionClientId;

    /**
     * @return string
     */
    public function getExtensionClientId(): string
    {
        return $this->extensionClientId;
    }
}
