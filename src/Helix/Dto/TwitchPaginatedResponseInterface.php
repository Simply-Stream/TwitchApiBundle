<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

interface TwitchPaginatedResponseInterface
{
    public function getPagination(): ?array;

    public function getTotal(): ?int;
}
