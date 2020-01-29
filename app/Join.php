<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
  public function user()
  {
      return $this->belongsTo('App\User');
  }
  public function step()
  {
      return $this->belongsTo('App\Step');
  }
}
