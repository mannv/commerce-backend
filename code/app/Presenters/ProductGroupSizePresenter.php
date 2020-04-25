<?php

namespace App\Presenters;

use App\Transformers\ProductGroupSizeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductGroupSizePresenter.
 *
 * @package namespace App\Presenters;
 */
class ProductGroupSizePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductGroupSizeTransformer();
    }
}
