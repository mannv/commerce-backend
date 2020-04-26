<?php

namespace App\Repositories;

use App\Entities\ProductGroupImage;
use App\Presenters\ProductGroupImagePresenter;
use App\Validators\ProductGroupImageValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductGroupImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductGroupImageRepositoryEloquent extends MyRepositoryEloquent implements ProductGroupImageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductGroupImage::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ProductGroupImageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(ProductGroupImagePresenter::class));
    }

}
