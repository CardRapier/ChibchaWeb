<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeuser_id($query , $id){
        if($id)
            return $query->where('user_id', $id);
    }
    public function scopeName($query , $name){
        if($name)
            return $query->where('name','LIKE', "%$name%");
    }
}
