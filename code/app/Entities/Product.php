<?php

namespace App\Entities;

class Product extends BaseEntity
{
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cate_id', 'name', 'price', 'old_price', 'description', 'crawler_url', 'is_crawler'];

}
