<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campaigndonationvalues extends Model
{

    protected $guard = [];
    protected $table = 'campaigndonationvalues';

    public function campaign()
    {
        return $this->belongsTo(campaign::class);
    }

    public function campaigndonation()
    {
        return $this->belongsTo(campaigndonation::class);
    }
}