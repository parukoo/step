<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
  protected $fillable = [
    'title', 'category_id', 'info',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function category()
  {
    return $this->belongsTo('App\Category');
  }
  public function kosteps()
  {
    return $this->hasMany('App\Kostep');
  }
}
