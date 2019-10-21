<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
