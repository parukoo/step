<?php

namespace STEP;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
  public function user()
  {
      return $this->belongsTo('STEP\User');
  }
  public function step()
  {
      return $this->belongsTo('STEP\Step');
  }
}
