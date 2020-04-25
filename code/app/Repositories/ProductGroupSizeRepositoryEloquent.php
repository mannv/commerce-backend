<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductGroupSizeRepository;
use App\Entities\ProductGroupSize;
use App\Validators\ProductGroupSizeValidator;

/**
 * Class ProductGroupSizeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductGroupSizeRepositoryEloquent extends BaseRepository implements ProductGroupSizeRepository
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
    }
    
}
