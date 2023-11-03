<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Predictions;

use Webmozart\Assert\Assert;

final readonly class EndPredictionRequest
{
    /**
     * @param string $broadcasterId    The ID of the broadcaster that’s running the prediction. This ID must match the user ID in the user
     *                                 access token.
     * @param string $id               The ID of the prediction to update.
     * @param string $status           The status to set the prediction to. Possible case-sensitive values are:
     *                                 - RESOLVED — The winning outcome is determined and the Channel Points are distributed to the viewers
     *                                 who predicted the correct outcome.
     *                                 - CANCELED — The broadcaster is canceling the prediction and sending refunds to the participants.
     *                                 - LOCKED — The broadcaster is locking the prediction, which means viewers may no longer make
     *                                 predictions. The broadcaster can update an active prediction to LOCKED, RESOLVED, or CANCELED; and
     *                                 update a locked prediction to RESOLVED or CANCELED.
     *
     *                                 The broadcaster has up to 24 hours after the prediction window closes to resolve the prediction. If
     *                                 not, Twitch sets the status to CANCELED and returns the points.
     * @param string $winningOutcomeId The ID of the winning outcome. You must set this parameter if you set status to RESOLVED.
     */
    public function __construct(
        private string $broadcasterId,
        private string $id,
        private string $status,
        private string $winningOutcomeId
    ) {
        Assert::stringNotEmpty($this->broadcasterId, 'Broadcaster ID can\'t be empty');
        Assert::stringNotEmpty($this->id, 'ID can\'t be empty');
        Assert::inArray($this->status, ['RESOLVED', 'CANCELED', 'LOCKED'], sprintf('Status is invalid. Possible values: RESOLVED, CANCELED, LOCKED. Got: %s', $this->status));

        if ($this->status === 'RESOLVED') {
            Assert::stringNotEmpty($this->winningOutcomeId, 'Winning outcome id can\'t be empty, when status is RESOLVED');
        }
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getWinningOutcomeId(): string {
        return $this->winningOutcomeId;
    }
}
