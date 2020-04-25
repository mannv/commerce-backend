<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Color;

/**
 * Class ColorTransformer.
 *
 * @package namespace App\Transformers;
 */
class ColorTransformer extends TransformerAbstract
{
    /**
     * Transform the Color entity.
     *
     * @param \App\Entities\Color $model
     *
     * @return array
     */
    public function transform(Color $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
