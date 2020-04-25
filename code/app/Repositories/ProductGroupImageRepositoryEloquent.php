<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductGroupImageRepository;
use App\Entities\ProductGroupImage;
use App\Validators\ProductGroupImageValidator;

/**
 * Class ProductGroupImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductGroupImageRepositoryEloquent extends BaseRepository implements ProductGroupImageRepository
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
    }
    
}
