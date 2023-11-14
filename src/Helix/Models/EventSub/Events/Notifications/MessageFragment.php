<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class MessageFragment
{
    use SerializesModels;

    /**
     * @param string         $type      The type of message fragment. Possible values:
     *                                  - text
     *                                  - cheermote
     *                                  - emote
     *                                  - mention
     * @param string         $text      Message text in fragment
     * @param Cheermote|null $cheermote Optional. Metadata pertaining to the cheermote.
     * @param Emote|null     $emote     Optional. Metadata pertaining to the emote.
     * @param Mention|null   $mention   Optional. Metadata pertaining to the mention.
     */
    public function __construct(
        private string $type,
        private string $text,
        private ?Cheermote $cheermote = null,
        private ?Emote $emote = null,
        private ?Mention $mention = null
    ) {
    }

    public function getType(): string {
        return $this->type;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getCheermote(): Cheermote {
        return $this->cheermote;
    }

    public function getEmote(): Emote {
        return $this->emote;
    }

    public function getMention(): Mention {
        return $this->mention;
    }
}
