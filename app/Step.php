<?php

namespace STEP;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
  protected $fillable = [
    'title', 'category_id', 'info',
  ];

  public function user()
  {
    return $this->belongsTo('STEP\User');
  }
  public function category()
  {
    return $this->belongsTo('STEP\Category');
  }
  public function kosteps()
  {
    return $this->hasMany('STEP\Kostep');
  }
  public function completes()
  {
    return $this->hasMany('STEP\Complete');
  }
}
