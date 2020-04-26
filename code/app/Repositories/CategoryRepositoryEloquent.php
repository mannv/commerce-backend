<?php

namespace App\Repositories;

use App\Entities\Category;
use App\Presenters\CategoryPresenter;
use App\Validators\CategoryValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends MyRepositoryEloquent implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return CategoryValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(CategoryPresenter::class));
    }

}
