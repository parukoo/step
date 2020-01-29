<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kostep extends Model
{
  protected $fillable = [
    'title', 'info', 'complete',
  ];

  public function step()
  {
    return $this->belongsTo('App\Step');
  }
  public function joins()
  {
    return $this->hasMany('App\Join');
  }
  public function completes()
  {
      return $this->hasMany('App\Complete');
  }
}
