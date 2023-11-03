<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Analytics;

final readonly class ExtensionAnalytics
{
    /**
     * @param string    $extensionId An ID that identifies the extension that the report was generated for.
     * @param string    $URL         The URL that you use to download the report. The URL is valid for 5 minutes.
     * @param string    $type        The type of report.
     * @param DateRange $dateRange   The reporting window’s start and end dates, in RFC3339 format.
     */
    public function __construct(
        private string $extensionId,
        private string $URL,
        private string $type,
        private DateRange $dateRange
    ) {
    }

    public function getExtensionId(): string {
        return $this->extensionId;
    }

    public function getURL(): string {
        return $this->URL;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDateRange(): DateRange {
        return $this->dateRange;
    }
}
