<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Size;

/**
 * Class SizeTransformer.
 *
 * @package namespace App\Transformers;
 */
class SizeTransformer extends TransformerAbstract
{
    /**
     * Transform the Size entity.
     *
     * @param \App\Entities\Size $model
     *
     * @return array
     */
    public function transform(Size $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
