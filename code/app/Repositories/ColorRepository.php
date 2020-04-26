<?php

namespace App\Repositories;

/**
 * Interface ColorRepository.
 *
 * @package namespace App\Repositories;
 */
interface ColorRepository extends MyRepository
{
    public function getByName(string $name);
}
