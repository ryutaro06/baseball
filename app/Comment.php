<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'topic_id' => 'required',
        'user_id' => 'required',
        'comment' => 'required',
        );
    
    public function comment_histories()
    {
        
        return $this->hasMany('App\CommentHistory');
    }
        
        
}
