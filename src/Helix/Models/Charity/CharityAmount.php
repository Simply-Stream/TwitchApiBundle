<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Charity;

final readonly class CharityAmount
{
    /**
     * @param int    $value         The monetary amount. The amount is specified in the currency’s minor unit. For example, the minor units
     *                              for USD is cents, so if the amount is $5.50 USD, value is set to 550.
     * @param int    $decimalPlaces The number of decimal places used by the currency. For example, USD uses two decimal places. Use this
     *                              number to translate value from minor units to major units by using the formula:
     *                              value / 10^decimal_places
     * @param string $currency      The ISO-4217 three-letter currency code that identifies the type of currency in value.
     */
    public function __construct(
        private int $value,
        private int $decimalPlaces,
        private string $currency
    ) {
    }

    public function getValue(): int {
        return $this->value;
    }

    public function getDecimalPlaces(): int {
        return $this->decimalPlaces;
    }

    public function getCurrency(): string {
        return $this->currency;
    }
}
