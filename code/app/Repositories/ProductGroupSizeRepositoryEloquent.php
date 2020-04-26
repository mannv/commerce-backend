<?php

namespace App\Repositories;

use App\Entities\ProductGroupSize;
use App\Presenters\ProductGroupSizePresenter;
use App\Validators\ProductGroupSizeValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductGroupSizeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductGroupSizeRepositoryEloquent extends MyRepositoryEloquent implements ProductGroupSizeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductGroupSize::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ProductGroupSizeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(ProductGroupSizePresenter::class));
    }

}
