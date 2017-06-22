<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{

    protected $guard = [];
    protected $table = 'campaigns';

    public function campaigndonationvalues()
    {
        return $this->hasMany(campaigndonationvalues::class);
    }

    public function secondarygoalsvalue()
    {
        return $this->hasMany(secondarygoalsvalue::class);
    }

    public function secondarygoals()
    {
        return $this->hasOne(secondarygoals::class);
    }    

    public function primarygoals()
    {
        return $this->hasOne(primarygoals::class);
    }
    
}