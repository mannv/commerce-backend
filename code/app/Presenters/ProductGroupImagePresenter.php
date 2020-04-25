<?php

namespace App\Presenters;

use App\Transformers\ProductGroupImageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductGroupImagePresenter.
 *
 * @package namespace App\Presenters;
 */
class ProductGroupImagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductGroupImageTransformer();
    }
}
