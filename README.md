# Twitch API Bundle

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require simply-stream/twitch-api-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require simply-stream/twitch-api-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    SimplyStream\TwitchApiBundle\SimplyStreamTwitchApiBundle::class => ['all' => true],
];
```

Configuration
=============

Following configuration is required:

```yaml
    simplystream_twitch_api:
        # Can set a static client_credential
        token:
            client_credentials:
                token: '123'
                expires_in: 1000
                token_type: 'Bearer'
        # Any \Symfony\Contracts\HttpClient\HttpClientInterface implementation
        http_client: 'http_client'
        # Currently the jms_serializer, but the intention is to support more
        serializer: 'jms_serializer'
        # See https://dev.twitch.tv/docs/authentication#registration on how to get client id and secret
        twitch_id: '%env(TWITCH_ID)%'
        twitch_secret: '%env(TWITCH_SECRET)%'
        # The url your user will be redirected to in authentication process
        redirect_uri: '%env(TWITCH_REDIRECT_URI)%'
        # The secret used in https://dev.twitch.tv/docs/eventsub#subscriptions to validate against manipulation.
        webhook:
            secret: '%env(TWITCH_WEBHOOK_SECRET)%'
```
