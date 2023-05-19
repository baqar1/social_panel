<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public function messages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }
    
    public function unreadMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id')->where('read', false);
    }
    






}
