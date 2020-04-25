<?php

namespace App\Entities;

class ProductGroupImage extends BaseEntity
{
    protected $table = 'product_group_images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_group_id', 'image', 'cover_image'];

}
