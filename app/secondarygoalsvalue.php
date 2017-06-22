<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class secondarygoalsvalue extends Model
{

    protected $guard = [];
    protected $table = 'secondarygoalsvalue';

    public function campaign()
    {
        return $this->belongsTo(campaign::class);
    }

    public function secondarygoals()
    {
        return $this->belongsTo(secondarygoals::class);
    }
}