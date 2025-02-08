<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

    // เชื่อมกับตาราง users (Many to One)
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'ผู้ใช้ที่ถูกลบ' // Default name when user is null
        ]);
    }

    public function replies()
    {
        return $this->hasMany(Replie::class);
    }
}