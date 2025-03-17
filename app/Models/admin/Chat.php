<?php

namespace App\Models\admin;

use App\Models\User;
use App\Models\admin\Message;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['type', 'user_id', 'receiver_id', 'title'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}