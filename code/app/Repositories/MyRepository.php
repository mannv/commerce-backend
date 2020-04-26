<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MyRepository extends RepositoryInterface
{
    public function addMulti(array $values);

    public function getFirst(array $where = [], array $columns = ['*']);
}
