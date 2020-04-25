<?php

namespace App\Entities;

class Color extends BaseEntity
{
    protected $table = 'colors';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'hex_color'];

}
