<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

use Webmozart\Assert\Assert;

final readonly class ExtensionBitsAmount
{
    /**
     * @param int    $amount The product’s price.
     * @param string $type   The type of currency. Possible values are:
     *                       - bits
     */
    public function __construct(
        private int $amount,
        private string $type
    ) {
        Assert::inArray($this->type, ['bits']);

        if ($this->type === 'bits') {
            Assert::greaterThanEq($this->amount, 1, 'The minimum price is 1');
            Assert::lessThanEq($this->amount, 10000, 'The minimum price is 10000');
        }
    }

    public function getAmount(): int {
        return $this->amount;
    }

    public function getType(): string {
        return $this->type;
    }
}
