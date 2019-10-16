<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as Model;

class UserInfo extends Model
{

    public $table = 'user_info';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function master() {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    function getList() {
        $users = DB::table('user_info')
            ->latest()
            ->get();
        return $users;
    }
    
    function getUser($userId) {
        $user = UserInfo::where('id', $userId)
            ->first()
            ->toArray();
        return $user;
    }

}
