<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project_post;
use App\Models\Semester;

class AllStudentController extends Controller
{
    public function allStudents(){
        $users = User::get();
        return view('admin.allStudents',compact('users'));
    }
}
