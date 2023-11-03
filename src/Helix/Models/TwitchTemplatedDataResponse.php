<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models;

/**
 * @template T
 */
readonly class TwitchTemplatedDataResponse extends TwitchDataResponse
{
    /**
     * @param T      $data
     * @param string $template A templated URL. Use the values from the id, format, scale, and theme_mode fields to replace the like-named
     *                         placeholder strings in the templated URL to create a CDN (content delivery network) URL that you use to
     *                         fetch the emote. For information about what the template looks like and how to use it to fetch emotes, see
     *                         Emote CDN URL format. You should use this template instead of using the URLs in the images object.
     */
    public function __construct(
        mixed $data,
        protected string $template
    ) {
        parent::__construct($data);
    }

    public function getTemplate(): string {
        return $this->template;
    }
}
