<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'title',
        'price',
        'count',
        'total',
        'body',
        'created_at',
        'updated_at',
        'category_id',
        'client_id',
        'approach_id',
        'user_id',
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * userテーブルとリレーション
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     *clientテーブルとリレーション
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    /**
     * approachテーブルとリレーション
     */
    public function approach()
    {
        return $this->belongsTo('App\Models\Approach');
    }

    // カテゴリーのスコープ
    public function scopeCategoryId($query, $category_id)
    {
        if (empty($category_id)) {
            return;
        }
        return $query->where('category_id', $category_id);
    }

    /**
     * clientのスコープ
     */
    public function scopeClientID($query, $client_id)
    {
        if (empty($client_id)) {
            return;
        }
        return $query->where('client_id', $client_id);
    }
    /**
     * approachのスコープ
     */
    public function scopeApproachId($query, $approach_id)
    {
        if (empty($approach_id)) {
            return;
        }
        return $query->where('approach_id', $approach_id);
    }
    /**
     *  ワード検索のスコープ
     */
    public function scopeSearchWords($query, $searchword)
    {
        if (empty($searchword)) {
            return;
        }
        return $query->where(function ($query) use ($searchword) {
            $query->orWhere('title', 'like', "%{$searchword}%")
                ->orWhere('body', 'like', "%{$searchword}%");
        });
    }

    public function getTotalPrice()
    {
        $this->total = $this->price * $this->count;
    }
}
