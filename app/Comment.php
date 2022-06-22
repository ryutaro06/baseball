<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'topic_id' => 'required',
        'comment' => 'required',
        'edited_at' => 'required',
        'user_name' => 'required',
        );
    

        
        
}
