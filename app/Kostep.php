<?php

namespace STEP;

use Illuminate\Database\Eloquent\Model;

class Kostep extends Model
{
  protected $fillable = [
    'title', 'info', 'complete',
  ];

  public function step()
  {
    return $this->belongsTo('STEP\Step');
  }
  public function joins()
  {
    return $this->hasMany('STEP\Join');
  }
  public function completes()
  {
      return $this->hasMany('STEP\Complete');
  }
}
