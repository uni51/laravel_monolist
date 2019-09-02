<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['code', 'name', 'url', 'image_url'];

    public function users()
    {
        // Laravel では中間テーブルに対応する存在を Pivot と呼びます。
        // type は通常の中間テーブルには無いカラムなので、 withPivot('type') として、
        // type を考慮する必要があることを伝えています
        // withTimestamps() は中間テーブルにも created_at と updated_at を保存するためのメソッド
        return $this->belongsToMany(User::class)->withPivot('type')->withTimestamps();
    }

    public function want_users()
    {
        return $this->users()->where('type', 'want');
    }
}
