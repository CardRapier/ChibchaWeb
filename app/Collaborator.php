<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'user_id', 'hosting_id', 'collaboration_level'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hosting()
    {
        return $this->belongsTo(Hosting::class);
    }
}
