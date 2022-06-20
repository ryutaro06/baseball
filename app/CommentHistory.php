<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentHistory extends Model
{
    //
        protected $guarded = array('id');
    
        public static $rules = array(
            'comment_id' => 'required',
            'edited_at' => 'required',
        );
}
