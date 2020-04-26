<?php

namespace App\Repositories;

use App\Entities\Size;
use App\Presenters\SizePresenter;
use App\Validators\SizeValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class SizeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SizeRepositoryEloquent extends MyRepositoryEloquent implements SizeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Size::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return SizeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(SizePresenter::class));
    }

}
