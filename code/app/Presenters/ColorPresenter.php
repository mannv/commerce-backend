<?php

namespace App\Presenters;

use App\Transformers\ColorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ColorPresenter.
 *
 * @package namespace App\Presenters;
 */
class ColorPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ColorTransformer();
    }
}
