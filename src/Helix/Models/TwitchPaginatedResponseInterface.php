<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models;

interface TwitchPaginatedResponseInterface
{
    public function getPagination(): Pagination;
}
