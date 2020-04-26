<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;


class MyRepositoryEloquent extends BaseRepository implements MyRepository
{

    public function model()
    {
        return '';
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        //
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        //
    }

    public function addMulti(array $values)
    {
        return $this->model->insert($values);
    }

    public function getFirst(array $where = [], array $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($where) {
            $this->applyConditions($where);
        }

        $result = $this->model->first($columns);

        $this->resetModel();
        $this->resetScope();

        if (empty($result)) {
            return [];
        }
        return $this->parserResult($result);
    }
}
