<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Predictions;

use Webmozart\Assert\Assert;

final readonly class CreatePredictionRequest
{
    /**
     * @param string               $broadcasterId    The ID of the broadcaster that’s running the prediction. This ID must match the user ID
     *                                               in the user access token.
     * @param string               $title            The question that the broadcaster is asking. For example, Will I finish this entire
     *                                               pizza? The title is limited to a maximum of 45 characters.
     * @param array{title: string} $outcomes         The list of possible outcomes that the viewers may choose from. The list must contain a
     *                                               minimum of 2 choices and up to a maximum of 10 choices.
     * @param int                  $predictionWindow The length of time (in seconds) that the prediction will run for. The minimum is 30
     *                                               seconds and the maximum is 1800 seconds (30 minutes).
     */
    public function __construct(
        private string $broadcasterId,
        private string $title,
        private array $outcomes,
        private int $predictionWindow
    ) {
        Assert::stringNotEmpty($this->broadcasterId, 'Broadcaster ID can\'t be empty');
        Assert::stringNotEmpty($this->title, 'Title can\'t be empty');
        Assert::maxLength($this->title, 45, 'Title can\'t be longer than 45 characters');
        Assert::greaterThanEq($this->predictionWindow, 30, 'Prediction window needs to be at least 30 seconds');
        Assert::lessThanEq($this->predictionWindow, 1800, 'Prediction window can\'t be longer than 1800 seconds');
    }
}
