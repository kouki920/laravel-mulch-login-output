<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function getLists()
    {
        /*
         * キーがidでバリューがnameのコレクションを生成
         */
        $categories = Category::orderBy('id','asc')->pluck('name', 'id');

        return $categories;
    }


}
