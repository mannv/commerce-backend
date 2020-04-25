<?php

namespace App\Entities;

class Size extends BaseEntity
{
    protected $table = 'sizes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
