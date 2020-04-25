<?php

namespace App\Entities;

class ProductGroup extends BaseEntity
{
    protected $table = 'product_groups';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'color_id'];

}
