<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ExtensionReport
{
    /**
     * An ID that identifies the extension that the report was generated for.
     *
     * @var string
     */
    protected string $extension_id;

    /**
     * The URL that you use to download the report. The URL is valid for 5 minutes.
     *
     * @var string
     */
    protected string $URL;

    /**
     * The type of report.
     *
     * @var string
     */
    protected string $type;

    /**
     * @return string
     */
    public function getExtensionId(): string
    {
        return $this->extension_id;
    }

    /**
     * @param string $extension_id
     *
     * @return ExtensionReport
     */
    public function setExtensionId(string $extension_id): ExtensionReport
    {
        $this->extension_id = $extension_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getURL(): string
    {
        return $this->URL;
    }

    /**
     * @param string $URL
     *
     * @return ExtensionReport
     */
    public function setURL(string $URL): ExtensionReport
    {
        $this->URL = $URL;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return ExtensionReport
     */
    public function setType(string $type): ExtensionReport
    {
        $this->type = $type;

        return $this;
    }
}
