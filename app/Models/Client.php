<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function getClient()
    {
        $clients = Client::orderBy('id', 'asc')->pluck('type', 'id');
        return $clients;
    }
}
