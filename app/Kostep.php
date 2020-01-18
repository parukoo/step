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
}
