<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\Api
 */
class TwitchApi
{
    public function __construct(
        protected AnalyticsApi $analyticsApi,
        protected BitsApi $bitsApi,
        protected ChannelPointsApi $channelPointsApi,
        protected ChannelsApi $channelsApi,
        protected CharityApi $charityApi,
        protected ChatApi $chatApi,
        protected ClipsApi $clipsApi,
        protected AdsApi $adsApi,
        protected EntitlementsApi $entitlementsApi,
        protected EventSubApi $eventSubApi,
        protected ExtensionsApi $extensionsApi,
        protected GamesApi $gamesApi,
        protected GoalsApi $goalsApi,
        protected HypeTrainApi $hypeTrainApi,
        protected ModerationApi $moderationApi,
        protected PollsApi $pollsApi,
        protected PredictionsApi $predictionsApi,
        protected RaidsApi $raidsApi,
        protected ScheduleApi $scheduleApi,
        protected SearchApi $searchApi,
        protected StreamsApi $streamsApi,
        protected SubscriptionsApi $subscriptionsApi,
        protected TeamsApi $teamsApi,
        protected UsersApi $usersApi,
        protected VideosApi $videosApi,
        protected WhispersApi $whispersApi,
    ) {
    }

    /**
     * @return AnalyticsApi
     */
    public function getAnalyticsApi(): AnalyticsApi
    {
        return $this->analyticsApi;
    }

    /**
     * @return BitsApi
     */
    public function getBitsApi(): BitsApi
    {
        return $this->bitsApi;
    }

    /**
     * @return ChannelPointsApi
     */
    public function getChannelPointsApi(): ChannelPointsApi
    {
        return $this->channelPointsApi;
    }

    /**
     * @return ChannelsApi
     */
    public function getChannelsApi(): ChannelsApi
    {
        return $this->channelsApi;
    }

    /**
     * @return CharityApi
     */
    public function getCharityApi(): CharityApi
    {
        return $this->charityApi;
    }

    /**
     * @return ChatApi
     */
    public function getChatApi(): ChatApi
    {
        return $this->chatApi;
    }

    /**
     * @return ClipsApi
     */
    public function getClipsApi(): ClipsApi
    {
        return $this->clipsApi;
    }

    /**
     * @return AdsApi
     */
    public function getAdsApi(): AdsApi
    {
        return $this->adsApi;
    }

    /**
     * @return EntitlementsApi
     */
    public function getEntitlementsApi(): EntitlementsApi
    {
        return $this->entitlementsApi;
    }

    /**
     * @return EventSubApi
     */
    public function getEventSubApi(): EventSubApi
    {
        return $this->eventSubApi;
    }

    /**
     * @return ExtensionsApi
     */
    public function getExtensionsApi(): ExtensionsApi
    {
        return $this->extensionsApi;
    }

    /**
     * @return GamesApi
     */
    public function getGamesApi(): GamesApi
    {
        return $this->gamesApi;
    }

    /**
     * @return GoalsApi
     */
    public function getGoalsApi(): GoalsApi
    {
        return $this->goalsApi;
    }

    /**
     * @return HypeTrainApi
     */
    public function getHypeTrainApi(): HypeTrainApi
    {
        return $this->hypeTrainApi;
    }

    /**
     * @return ModerationApi
     */
    public function getModerationApi(): ModerationApi
    {
        return $this->moderationApi;
    }

    /**
     * @return PollsApi
     */
    public function getPollsApi(): PollsApi
    {
        return $this->pollsApi;
    }

    /**
     * @return PredictionsApi
     */
    public function getPredictionsApi(): PredictionsApi
    {
        return $this->predictionsApi;
    }

    /**
     * @return RaidsApi
     */
    public function getRaidsApi(): RaidsApi
    {
        return $this->raidsApi;
    }

    /**
     * @return ScheduleApi
     */
    public function getScheduleApi(): ScheduleApi
    {
        return $this->scheduleApi;
    }

    /**
     * @return SearchApi
     */
    public function getSearchApi(): SearchApi
    {
        return $this->searchApi;
    }

    /**
     * @return StreamsApi
     */
    public function getStreamsApi(): StreamsApi
    {
        return $this->streamsApi;
    }

    /**
     * @return SubscriptionsApi
     */
    public function getSubscriptionsApi(): SubscriptionsApi
    {
        return $this->subscriptionsApi;
    }

    /**
     * @return TeamsApi
     */
    public function getTeamsApi(): TeamsApi
    {
        return $this->teamsApi;
    }

    /**
     * @return UsersApi
     */
    public function getUsersApi(): UsersApi
    {
        return $this->usersApi;
    }

    /**
     * @return VideosApi
     */
    public function getVideosApi(): VideosApi
    {
        return $this->videosApi;
    }

    /**
     * @return WhispersApi
     */
    public function getWhispersApi(): WhispersApi
    {
        return $this->whispersApi;
    }
}
