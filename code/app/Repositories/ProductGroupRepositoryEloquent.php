<?php

namespace App\Repositories;

use App\Entities\ProductGroup;
use App\Presenters\ProductGroupPresenter;
use App\Validators\ProductGroupValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductGroupRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductGroupRepositoryEloquent extends MyRepositoryEloquent implements ProductGroupRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductGroup::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ProductGroupValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(ProductGroupPresenter::class));
    }

}
