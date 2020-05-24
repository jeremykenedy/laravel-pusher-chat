<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the user that owns the chat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
