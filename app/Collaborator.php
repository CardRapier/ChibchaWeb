<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $primaryKey = ['user_id', 'hosting_id'];
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hosting()
    {
        return $this->belongsTo(Hosting::class);
    }
}
