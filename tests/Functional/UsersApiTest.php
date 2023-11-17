<?php

namespace SimplyStream\TwitchApiBundle\Tests\Functional;

use League\OAuth2\Client\Token\AccessToken;
use SimplyStream\TwitchApiBundle\Helix\Models\Pagination;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchPaginatedDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\Users\Component;
use SimplyStream\TwitchApiBundle\Helix\Models\Users\Overlay;
use SimplyStream\TwitchApiBundle\Helix\Models\Users\Panel;
use SimplyStream\TwitchApiBundle\Helix\Models\Users\UpdateUserExtension;
use SimplyStream\TwitchApiBundle\Helix\Models\Users\User;
use SimplyStream\TwitchApiBundle\Helix\Models\Users\UserActiveExtension;
use SimplyStream\TwitchApiBundle\Helix\Models\Users\UserExtension;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Webmozart\Assert\InvalidArgumentException;

class UsersApiTest extends KernelTestCase
{
    public function testGetUsers() {
        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<'JSON'
{
  "data": [
    {
      "id": "123456789",
      "login": "some_username",
      "display_name": "Some_Username",
      "type": "",
      "broadcaster_type": "affiliate",
      "description": "This is a nice description",
      "profile_image_url": "https://static-cdn.jtvnw.net/jtv_user_pictures/1234-profile_image-300x300.png",
      "offline_image_url": "",
      "view_count": 0,
      "created_at": "2014-11-12T20:07:52Z"
    }
  ]
}
JSON
                )
            ]);

        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersResponse = $usersApi->getUsers(logins: ['some_username'], accessToken: new AccessToken(['access_token' => '123', 'token_type' => 'Bearer']));

        $this->assertInstanceOf(TwitchDataResponse::class, $usersResponse);
        $this->assertIsArray($usersResponse->getData());
        $this->assertCount(1, $usersResponse->getData());

        foreach ($usersResponse->getData() as $user) {
            $this->assertInstanceOf(User::class, $user);
            $this->assertSame('123456789', $user->getId());
            $this->assertSame('some_username', $user->getLogin());
            $this->assertSame('Some_Username', $user->getDisplayName());
            $this->assertSame('affiliate', $user->getBroadcasterType());
            $this->assertSame('This is a nice description', $user->getDescription());
            $this->assertSame(0, $user->getViewCount());
            $this->assertSame('https://static-cdn.jtvnw.net/jtv_user_pictures/1234-profile_image-300x300.png', $user->getProfileImageUrl());
            $this->assertInstanceOf(\DateTimeImmutable::class, $user->getCreatedAt());
            $this->assertEquals(new \DateTimeImmutable('2014-11-12T20:07:52Z'), $user->getCreatedAt());
        }
    }

    public function testGetUSersThrowsExceptionWhenIdOrLoginsIsNotSet() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('You need to specify at least one "id" or "login"');

        $container = self::$kernel->getContainer();
        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersApi->getUsers();
    }

    /**
     * @return void
     * @dataProvider getUsersThrowsExceptionWhenMoreThan100UsersAreRequestedDataProvider
     */
    public function testGetUsersThrowsExceptionWhenMoreThan100UsersAreRequested(array $ids, array $logins) {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('You can only request a total amount of 100 users at once');

        $container = self::$kernel->getContainer();
        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersApi->getUsers(ids: $ids, logins: $logins);
    }

    public function testUpdateUser() {
        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<'JSON'
{
  "data": [
    {
      "id": "12345678",
      "login": "some_user",
      "display_name": "Some_User",
      "type": "",
      "broadcaster_type": "affiliate",
      "description": "This is a new description",
      "profile_image_url": "https://static-cdn.jtvnw.net/jtv_user_pictures/56712a97-profile_image-300x300.png",
      "offline_image_url": "",
      "view_count": 0,
      "created_at": "2014-11-12T20:07:52Z"
    }
  ]
}
JSON
                )
            ]);

        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);

        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $updateUserResponse = $usersApi->updateUser($accessToken, 'This is a new description');

        $this->assertInstanceOf(TwitchDataResponse::class, $updateUserResponse);
        $this->assertCount(1, $updateUserResponse->getData());

        foreach ($updateUserResponse->getData() as $user) {
            $this->assertInstanceOf(User::class, $user);
            $this->assertSame('12345678', $user->getId());
            $this->assertSame('some_user', $user->getLogin());
            $this->assertSame('Some_User', $user->getDisplayName());
            $this->assertSame('', $user->getType());
            $this->assertSame('affiliate', $user->getBroadcasterType());
            $this->assertSame('This is a new description', $user->getDescription());
            $this->assertSame('https://static-cdn.jtvnw.net/jtv_user_pictures/56712a97-profile_image-300x300.png', $user->getProfileImageUrl());
            $this->assertSame('', $user->getOfflineImageUrl());
            $this->assertSame(0, $user->getViewCount());
            $this->assertInstanceOf(\DateTimeImmutable::class, $user->getCreatedAt());
            $this->assertEquals(new \DateTimeImmutable('2014-11-12T20:07:52Z'), $user->getCreatedAt());
        }
    }

    public function testUpdateUserThrowsExceptionWhenDescriptionIsTooLong() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('A description can not be longer than 300 characters');

        $container = self::$kernel->getContainer();

        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);

        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersApi->updateUser($accessToken, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum');
    }

    public function testGetUsersBlockList() {
        $container = self::$kernel->getContainer();
        $container
            ->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<'JSON'
{
  "data": [
    {
      "user_id": "123456",
      "user_login": "blocked_user1",
      "display_name": "blocked_user1"
    },
    {
      "user_id": "12345",
      "user_login": "blocked_user2",
      "display_name": "blocked_user2"
    },
    {
      "user_id": "123456789",
      "user_login": "blocked_user3",
      "display_name": "blocked_user3"
    }
  ],
  "pagination": {
    "cursor": "eyJ1c2VyX2lkIjoiNzUwNDY5NDUiLCJ1c2VyX2lkI2Jsb2NrZWRfdXNlcl9pZCI6Ijc1MDQ2OTQ1IzY2ODIyNjI1OCIsImNyZWF0ZWRfb24jdXBkYXRlZF9vbiI6IjIwMjItMDEtMDhUMTM6MTM6MzIuMDk2WiMyMDIyLTAxLTA4VDEzOjEzOjMyLjA5NloifQ=="
  }
}
JSON
                )
            ]);

        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);
        $userBlockListResponse = $usersApi->getUserBlockList('123456', $accessToken);

        $this->assertInstanceOf(TwitchPaginatedDataResponse::class, $userBlockListResponse);
        $this->assertCount(3, $userBlockListResponse->getData());

        foreach ($userBlockListResponse->getData() as $block) {
            $this->assertIsString($block->getUserId());
            $this->assertIsString($block->getUserLogin());
            $this->assertIsString($block->getDisplayName());
        }

        $this->assertInstanceOf(Pagination::class, $userBlockListResponse->getPagination());
        $this->assertIsString($userBlockListResponse->getPagination()->getCursor());
    }

    public function testBlockUser() {
        // There won't be any response object to check (yet). The test is considered successful, when no exception is thrown
        $this->expectNotToPerformAssertions();

        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse('', ['http_code' => 204])
            ]);

        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);

        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersApi->blockUser('406576975', $accessToken);
    }

    public function testUnblockUser() {
        // There won't be any response object to check (yet). The test is considered successful, when no exception is thrown
        $this->expectNotToPerformAssertions();

        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse('', ['http_code' => 204])
            ]);

        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);

        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersApi->unblockUser('406576975', $accessToken);
    }

    public function testGetUserExtensions() {
        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<'JSON'
{
  "data": [
    {
      "id": "123456",
      "version": "1.0.0",
      "name": "Generic Extension",
      "can_activate": true,
      "type": [
        "mobile",
        "panel"
      ]
    }
  ]
}
JSON
                )
            ]);

        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);
        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersExtensionResponse = $usersApi->getUserExtensions($accessToken);

        $this->assertInstanceOf(TwitchDataResponse::class, $usersExtensionResponse);
        $this->assertCount(1, $usersExtensionResponse->getData());

        foreach ($usersExtensionResponse->getData() as $extension) {
            $this->assertInstanceOf(UserExtension::class, $extension);
            $this->assertTrue($extension->canActivate());
            $this->assertEquals('123456', $extension->getId());
        }
    }

    public function testGetUserActiveExtensionsWithUserToken() {
        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<'JSON'
{
  "data": {
    "panel": {
      "1": {
        "active": true,
        "id": "123456789",
        "version": "1.0.0",
        "name": "Some Extension"
      },
      "2": {
        "active": false
      },
      "3": {
        "active": false
      }
    },
    "overlay": {
      "1": {
        "active": false
      }
    },
    "component": {
      "1": {
        "active": false
      },
      "2": {
        "active": false
      }
    }
  }
}
JSON
                )
            ]);

        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);
        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersGetActiveExtensions = $usersApi->getUserActiveExtensions(accessToken: $accessToken);

        $this->assertInstanceOf(TwitchDataResponse::class, $usersGetActiveExtensions);
        $this->assertIsNotArray($usersGetActiveExtensions->getData());

        foreach ($usersGetActiveExtensions->getData() as $extension) {
            $this->assertInstanceOf(UserActiveExtension::class, $extension);
        }
    }

    public function testGetUserActiveExtensionsWithAppToken() {
        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<'JSON'
{
  "data": {
    "panel": {
      "1": {
        "active": false
      },
      "2": {
        "active": false
      },
      "3": {
        "active": false
      }
    },
    "overlay": {
      "1": {
        "active": false
      }
    },
    "component": {
      "1": {
        "active": false
      },
      "2": {
        "active": false
      }
    }
  }
}
JSON
                )
            ]);

        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $usersGetActiveExtensions = $usersApi->getUserActiveExtensions('123456789');

        $this->assertInstanceOf(TwitchDataResponse::class, $usersGetActiveExtensions);
        $this->assertIsNotArray($usersGetActiveExtensions->getData());

        foreach ($usersGetActiveExtensions->getData() as $extension) {
            $this->assertInstanceOf(UserActiveExtension::class, $extension);
        }
    }

    public function testUpdateUserExtensions() {
        // @TODO: Create an extension and validate this test
        $this->markTestSkipped('This test "might" be correct, but I can\'t actually validate the response.');

        $updateUserExtensionsBody = new UpdateUserExtension(json_decode(<<<'JSON'
{"data":{"panel":{"1":{"active":true,"id":"123","version":"1.2.5","name":"Some Extension"}}}}
JSON
            , true));

        $container = self::$kernel->getContainer();
        $container->get(MockHttpClient::class)
            ->setResponseFactory([
                new MockResponse(<<<JSON
{
  "data": {
    "panel": {
      "1": {
        "active": false,
        "id": "123",
        "version": "1.2.5",
        "name": "Some Extension"
      }
    },
    "overlay": {
      "1": {
        "active": false
      }
    },
    "component": {
      "1": {
        "active": false
      }
    }
  }
}
JSON
                )
            ]);

        $accessToken = new AccessToken(['access_token' => 'some_access_token', 'token_type' => 'Bearer']);
        $usersApi = $container->get('simplystream.twitch_api.helix_api.users');
        $updateUserExtensionsResponse = $usersApi->updateUserExtensions($updateUserExtensionsBody, $accessToken);

        $this->assertInstanceOf(TwitchDataResponse::class, $updateUserExtensionsResponse);

        $data = $updateUserExtensionsResponse->getData();

        $this->assertInstanceOf(UserActiveExtension::class, $data);
        $this->assertIsArray($data->getPanel());

        foreach ($data->getPanel() as $panel) {
            $this->assertInstanceOf(Panel::class, $panel);
        }

        $this->assertIsArray($data->getOverlay());

        foreach ($data->getOverlay() as $overlay) {
            $this->assertInstanceOf(Overlay::class, $overlay);
        }

        $this->assertIsArray($data->getComponent());

        foreach ($data->getComponent() as $component) {
            $this->assertInstanceOf(Component::class, $component);
        }
    }

    public function getUsersThrowsExceptionWhenMoreThan100UsersAreRequestedDataProvider() {
        // Just generate some strings, the content doesn't matter, we only need more than 100 keys
        return [
            'Test with 101 IDs' => [
                'id' => array_fill(0, 101, uniqid()),
                'logins' => []
            ],
            'Test with 101 logins' => [
                'id' => [],
                'logins' => array_fill(0, 101, uniqid()),
            ],
            'Test with 50 ids and 51 logins' => [
                'id' => array_fill(0, 50, uniqid()),
                'logins' => array_fill(0, 51, uniqid()),
            ]
        ];
    }

    protected function setUp(): void {
        self::bootKernel();
        parent::setUp();
    }
}
