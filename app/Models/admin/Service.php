<?php

namespace App\Models\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'status',
        'color',
        'size',
        'comment',
        'file',
        'user_id',
    ];

    /**
     * Get the user that owns the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}