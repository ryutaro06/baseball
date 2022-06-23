<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEdited extends Model
{
    
     /**
     * IDから一件のデータを取得する
    */
    public function selectUserFindByld($id)
    {
        //[SELECT id, name, email, password WHERE id = ?]を発行
        $query = $this->select([
            'id',
            'name',
            'email',
            'favorite_team',
            'password'
        ])->where([
            'id' => $id        
        ]);
        
        // first()は１件のみ取得する関数
        return $query->first();
    }
}
