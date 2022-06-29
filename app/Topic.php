<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        'team' => 'required',
        );
        
    //
    public function histories()
    {
        
        return $this->hasMany('App\History');
    }
    
    public function comments()
    {
        
        return $this->hasMany('App\Comment');
    }
}
