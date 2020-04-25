<?php

namespace App\Presenters;

use App\Transformers\ProductGroupTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductGroupPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProductGroupPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductGroupTransformer();
    }
}
