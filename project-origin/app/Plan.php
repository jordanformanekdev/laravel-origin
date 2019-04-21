<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'plan_id'
    ];

    protected $cast = [
      'price' => 'integer'
    ];

}
