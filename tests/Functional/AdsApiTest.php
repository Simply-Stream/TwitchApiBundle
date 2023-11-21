<?php

namespace SimplyStream\TwitchApiBundle\Tests\Functional;

use League\OAuth2\Client\Token\AccessToken;
use SimplyStream\TwitchApi\Helix\Models\Ads\Commercial;
use SimplyStream\TwitchApi\Helix\Models\Ads\StartCommercialRequest;
use SimplyStream\TwitchApi\Helix\Models\TwitchDataResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class AdsApiTest extends KernelTestCase
{
    public function testStartCommercial() {
        $container = self::getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<JSON
{
  "data": [
    {
      "length" : 30,
      "message" : "",
      "retry_after" : 480
    }
  ]
}
JSON
                )
            ]);

        $body = new StartCommercialRequest('123456', 30);
        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);

        $adsApi = $container->get('simplystream.twitch_api.helix_api.ads');
        $startCommercialResponse = $adsApi->startCommercial($body, $accessToken);

        $this->assertInstanceOf(TwitchDataResponse::class, $startCommercialResponse);
        $this->assertIsArray($startCommercialResponse->getData());

        foreach ($startCommercialResponse->getData() as $commercial) {
            $this->assertInstanceOf(Commercial::class, $commercial);
            $this->assertSame(30, $commercial->getLength());
            $this->assertSame("", $commercial->getMessage());
            $this->assertSame(480, $commercial->getRetryAfter());
        }
    }

    public function testGetAdSchedule() {
        $container = self::getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<JSON
{
  "data": [
    {
      "next_ad_at" : "2023-08-01T23:08:18+00:00",
      "last_ad_at" : "2023-08-01T23:08:18+00:00",
      "length_seconds" : 0,
      "preroll_free_time_seconds" : 0,
      "snooze_count" : 3,
      "snooze_refresh_at" : "2023-08-01T23:08:18+00:00"
    }
  ]
}
JSON
                )
            ]);
        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);

        $adsApi = $container->get('simplystream.twitch_api.helix_api.ads');
        $adScheduleResponse = $adsApi->getAdSchedule('123456', $accessToken);

        $this->assertInstanceOf(TwitchDataResponse::class, $adScheduleResponse);
        $this->assertIsArray($adScheduleResponse->getData());

        foreach ($adScheduleResponse->getData() as $schedule) {
            $this->assertSame(0, $schedule->getLengthSeconds());
            $this->assertSame(0, $schedule->getPrerollFreeTimeSeconds());
            $this->assertSame(3, $schedule->getSnoozeCount());
            $this->assertEquals(new \DateTimeImmutable("2023-08-01T23:08:18+00:00"), $schedule->getNextAdAt());
            $this->assertEquals(new \DateTimeImmutable("2023-08-01T23:08:18+00:00"), $schedule->getLastAdAt());
            $this->assertEquals(new \DateTimeImmutable("2023-08-01T23:08:18+00:00"), $schedule->getSnoozeRefreshAt());
        }
    }

    public function testSnoozeNextAd() {
        $container = self::getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<JSON
{
  "data": [
    {
      "snooze_count" : 2,
      "snooze_refresh_at" : "2023-08-01T23:08:18+00:00",
      "next_ad_at" : "2023-08-01T23:08:18+00:00"
    }
  ]
}
JSON
                )
            ]);
        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);

        $adsApi = $container->get('simplystream.twitch_api.helix_api.ads');
        $snoozeNextAdResponse = $adsApi->snoozeNextAd('123456', $accessToken);

        $this->assertInstanceOf(TwitchDataResponse::class, $snoozeNextAdResponse);
        $this->assertIsArray($snoozeNextAdResponse->getData());

        foreach ($snoozeNextAdResponse->getData() as $schedule) {
            $this->assertSame(2, $schedule->getSnoozeCount());
            $this->assertEquals(new \DateTimeImmutable("2023-08-01T23:08:18+00:00"), $schedule->getNextAdAt());
            $this->assertEquals(new \DateTimeImmutable("2023-08-01T23:08:18+00:00"), $schedule->getSnoozeRefreshAt());
        }
    }

    protected function setUp(): void {
        self::bootKernel();
        parent::setUp();
    }
}
