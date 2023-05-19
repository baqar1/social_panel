<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'project_title',
        'department',
        'project_name',
        'project_file',
        'project_description'
    ];
    protected $attributes = [
        'project_file' => 'default.jpg',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}



public function likes()
{
    return $this->hasMany(Like::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}




}
