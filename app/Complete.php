<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
  protected $table = 'completes';
  public function user()
  {
      return $this->belongsTo('App\User');
  }
  public function step()
  {
      return $this->belongsTo('App\Step');
  }
  public function kostep()
  {
      return $this->belongsTo('App\Kostep');
  }
}
