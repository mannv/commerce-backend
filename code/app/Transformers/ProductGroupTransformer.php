<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProductGroup;

/**
 * Class ProductGroupTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductGroupTransformer extends TransformerAbstract
{
    /**
     * Transform the ProductGroup entity.
     *
     * @param \App\Entities\ProductGroup $model
     *
     * @return array
     */
    public function transform(ProductGroup $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
