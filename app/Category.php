<?php

namespace STEP;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
      'name'
    ];
    public function steps()
    {
      return $this->hasMany('STEP\Step');
    }
}
