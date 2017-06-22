<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campaigndonation extends Model
{

    protected $guard = [];
    protected $table = 'campaigndonation';

    public function campaign()
    {
        return $this->belongsTo(campaign::class);
    }

    public function campaigndonationvalues()
    {
        return $this->hasMany(campaigndonationvalues::class);
    }
}