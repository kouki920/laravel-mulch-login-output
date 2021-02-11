<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Approach extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function getApproach()
    {
        $approach = Approach::orderBy('id', 'asc')->pluck('method', 'id');
        return $approach;
    }
}
