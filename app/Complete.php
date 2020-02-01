<?php

namespace STEP;

use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
  protected $table = 'completes';
  public function user()
  {
      return $this->belongsTo('STEP\User');
  }
  public function step()
  {
      return $this->belongsTo('STEP\Step');
  }
  public function kostep()
  {
      return $this->belongsTo('STEP\Kostep');
  }
}
