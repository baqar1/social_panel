<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'message',
        'read_at' // Add the read_at column here
    ];
    public function messages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }
    
    public function unreadMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id')->where('read', false);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    
    
    






}
