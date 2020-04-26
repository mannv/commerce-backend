<?php

namespace App\Repositories;

use App\Entities\Color;
use App\Presenters\ColorPresenter;
use App\Validators\ColorValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ColorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ColorRepositoryEloquent extends MyRepositoryEloquent implements ColorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Color::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ColorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(ColorPresenter::class));
    }

    public function getByName(string $name)
    {
        return $this->getFirst(['name' => $name]);
    }
}
