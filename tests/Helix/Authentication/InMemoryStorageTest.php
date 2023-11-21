<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Tests\Helix\Authentication;

use League\OAuth2\Client\Token\AccessTokenInterface;
use PHPUnit\Framework\TestCase;
use SimplyStream\TwitchApi\Helix\Authentication\Token\Storage\InMemoryStorage;

class InMemoryStorageTest extends TestCase
{
    public function testCanSaveToken(): void
    {
        $tokenMock = $this->createMock(AccessTokenInterface::class);
        $tokenMock
            ->method('getExpires')
            ->willReturn((new \DateTime('+10 minutes'))->format('U'));

        $sut = new InMemoryStorage();
        $token = $sut->save('test', $tokenMock);

        self::assertSame($tokenMock, $token);
    }

    public function testCanGetToken(): void
    {
        $tokenMock = $this->createMock(AccessTokenInterface::class);
        $tokenMock
            ->method('getExpires')
            ->willReturn((new \DateTime('+10 minutes'))->format('U'));

        $sut = new InMemoryStorage();
        $sut->save('test', $tokenMock);

        self::assertSame($tokenMock, $sut->get('test'));
    }

    public function testCanRemoveToken(): void
    {
        $tokenMock = $this->createMock(AccessTokenInterface::class);
        $tokenMock
            ->method('getExpires')
            ->willReturn((new \DateTime('+10 minutes'))->format('U'));

        $sut = new InMemoryStorage();
        $sut->save('test', $tokenMock);

        self::assertSame($tokenMock, $sut->get('test'));

        $sut->remove('test');

        self::assertEmpty($sut->get('test'));
    }

    public function testCanCheckIfTokenExists(): void
    {
        $tokenMock = $this->createMock(AccessTokenInterface::class);
        $tokenMock
            ->method('getExpires')
            ->willReturn((new \DateTime('+10 minutes'))->format('U'));

        $sut = new InMemoryStorage();
        self::assertFalse($sut->has('test'));
        $sut->save('test', $tokenMock);
        self::assertTrue($sut->has('test'));
    }

    public function testReturnsNotExpiredToken(): void
    {
        $tokenMock = $this->createMock(AccessTokenInterface::class);
        $tokenMock
            ->expects(self::exactly(2))
            ->method('getExpires')
            ->willReturn((new \DateTime('+10 minutes'))->format('U'));

        $sut = new InMemoryStorage();
        $sut->save('test', $tokenMock);

        self::assertTrue($sut->has('test'));
        self::assertSame($tokenMock, $sut->get('test'));
    }

    public function testIgnoresExpiredToken(): void
    {
        $tokenMock = $this->createMock(AccessTokenInterface::class);
        $tokenMock
            ->expects(self::exactly(2))
            ->method('getExpires')
            ->willReturn((new \DateTime('-10 minutes'))->format('U'));

        $sut = new InMemoryStorage();
        $sut->save('test', $tokenMock);

        self::assertFalse($sut->has('test'));
        self::assertEmpty($sut->get('test'));
    }
}
