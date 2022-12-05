<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

use InvalidArgumentException;

abstract class AbstractCondition implements ConditionInterface
{
    public const TYPE = null;

    protected array $requiredOptions = [
        'broadcasterUserId',
    ];

    public function __construct(array $options)
    {
        $this->assertRequiredOptions($options);

        foreach ($options as $key => $option) {
            if (property_exists(static::class, $key)) {
                $this->$key = $option;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return static::TYPE;
    }

    /**
     * {@inheritDoc}
     */
    public function getRequiredOptions(): array
    {
        return $this->requiredOptions;
    }

    /**
     * @TODO: Add possibility to make only a subset of parameters required.
     *        @see https://dev.twitch.tv/docs/eventsub/eventsub-reference#channel-raid-condition
     */
    protected function assertRequiredOptions(array $options): void
    {
        $missing = array_diff_key(array_flip($this->getRequiredOptions()), $options);

        if (! empty($missing)) {
            throw new InvalidArgumentException(
                'Required options not defined: ' . implode(', ', array_keys($missing))
            );
        }
    }
}
