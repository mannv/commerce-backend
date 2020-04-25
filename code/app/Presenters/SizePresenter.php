<?php

namespace App\Presenters;

use App\Transformers\SizeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SizePresenter.
 *
 * @package namespace App\Presenters;
 */
class SizePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SizeTransformer();
    }
}
