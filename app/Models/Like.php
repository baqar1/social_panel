<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'project_post_id'];

    public function project_post()
    {
        return $this->belongsTo(Project_Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
