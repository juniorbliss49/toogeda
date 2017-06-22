<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class primarygoals extends Model
{
    protected $table = 'primarygoals';

    public function campaign()
    {
        return belongsTo(campaign::class);
    }

}
