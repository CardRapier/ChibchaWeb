<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    public function scopeName($query , $name){
        if($name)
            return $query->where('name','LIKE', "%$name%");
    }
}
