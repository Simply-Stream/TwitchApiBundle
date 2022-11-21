<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

class Image
{
    /**
     * @var string
     */
    protected $url1x;

    /**
     * @var string
     */
    protected $url2x;

    /**
     * @var string
     */
    protected $url4x;

    /**
     * @return string
     */
    public function getUrl1x(): string
    {
        return $this->url1x;
    }

    /**
     * @param string $url1x
     *
     * @return $this
     */
    public function setUrl1x(string $url1x): self
    {
        $this->url1x = $url1x;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl2x(): string
    {
        return $this->url2x;
    }

    /**
     * @param string $url2x
     *
     * @return $this
     */
    public function setUrl2x(string $url2x): self
    {
        $this->url2x = $url2x;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl4x(): string
    {
        return $this->url4x;
    }

    /**
     * @param string $url4x
     *
     * @return $this
     */
    public function setUrl4x(string $url4x): self
    {
        $this->url4x = $url4x;

        return $this;
    }
}
