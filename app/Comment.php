<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  function relreptab(){
    return $this->hasmany('App\Reply', 'comment_id', 'id' );
  }
}
