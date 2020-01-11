<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  function reltocomtab(){
    return $this->hasmany('App\Comment');
  }
}
