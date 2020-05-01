<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activities extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'code', 'name', 'description', 'type'
    ];

    protected $dates = ['deleted_at'];
}
