<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class secondarygoals extends Model
{
    protected $table = 'secondarygoals';

    public function campaign()
    {
        return $this->belongsTo(campaign::class);
    }

    public function secondarygoalsvalue()
    {
    	return $this->hasMany(secondarygoalsvalue::class)
    }
}
