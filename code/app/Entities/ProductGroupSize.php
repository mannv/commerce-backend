<?php

namespace App\Entities;

class ProductGroupSize extends BaseEntity
{
    protected $table = 'product_group_sizes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_group_id', 'size_id', 'sku', 'quantity'];

}
