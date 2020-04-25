<?php

namespace App\Entities;

class Category extends BaseEntity
{
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'image'];

}
