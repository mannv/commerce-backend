<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProductGroupImage;

/**
 * Class ProductGroupImageTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductGroupImageTransformer extends TransformerAbstract
{
    /**
     * Transform the ProductGroupImage entity.
     *
     * @param \App\Entities\ProductGroupImage $model
     *
     * @return array
     */
    public function transform(ProductGroupImage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
