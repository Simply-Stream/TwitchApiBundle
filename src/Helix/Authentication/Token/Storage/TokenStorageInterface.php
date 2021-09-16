<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage;

use League\OAuth2\Client\Token\AccessTokenInterface;

interface TokenStorageInterface
{
    /**
     * Saves the AccessTokenInterfaces sent in arguments to storage.
     *
     * @param string               $key
     * @param AccessTokenInterface $token
     *
     * @return AccessTokenInterface
     */
    public function save(string $key, AccessTokenInterface $token): AccessTokenInterface;

    /**
     * Removes AccessTokenInterface by $key from storage.
     *
     * @param string $key
     *
     * @return void
     */
    public function remove(string $key): void;

    /**
     * Search and returns AccessTokenInterface from storage.
     *
     * @param string $key
     *
     * @return AccessTokenInterface|null
     */
    public function get(string $key): ?AccessTokenInterface;

    /**
     * Returns whether TokenStorageInterface has a valid AccessTokenInterface or not.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;
}
