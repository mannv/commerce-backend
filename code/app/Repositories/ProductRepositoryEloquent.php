<?php

namespace App\Repositories;

use App\Entities\Product;
use App\Presenters\ProductPresenter;
use App\Validators\ProductValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends MyRepositoryEloquent implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ProductValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(ProductPresenter::class));
    }

}
