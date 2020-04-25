<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProductGroupSize;

/**
 * Class ProductGroupSizeTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductGroupSizeTransformer extends TransformerAbstract
{
    /**
     * Transform the ProductGroupSize entity.
     *
     * @param \App\Entities\ProductGroupSize $model
     *
     * @return array
     */
    public function transform(ProductGroupSize $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
