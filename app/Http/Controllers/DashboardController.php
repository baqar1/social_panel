<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project_post;
use App\Models\Semester;

class DashboardController extends Controller
{  
    // <!-- Create Project post -->
    public function project_post(Request $request){
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if($request->has('project_file')){
            // dd($request->file('project_file'));
            $imageName = time().'.'.$request->file('project_file')->getClientOriginalName();  
            $request->file('project_file')->storeAs('uploads', $imageName, 'public');
        }
        $projectPosts = project_post::create([
            'user_id' => $request->user()->id,
            'project_title' => $request->project_title,
            'department' => $request->department,
            'project_name' => $request->project_name,
            'project_file' => $imageName?? null,
            'project_description' => $request->project_description,
        ]);
        
        return redirect(route('dashboard'));
    }


    // <!-- Create post -->
    public function post(Request $request){
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $Posts = post::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'department' => $request->department,
            'subject' => $request->subject,
            'image' => $request->image,
            'description' => $request->description,
        ]);
        
        return redirect(route('dashboard'));
    }

   
    // <!-- Dashboard main page function -->
    public function dashboard(Request $request)
    {
        $topProfiles = User::take(20)->get();
        $posts = Project_post::orderBy('created_at','desc')->get();
        $firstPost = Project_post::orderBy('created_at','desc')->first();
        // $data = Post::all();
        $data = Post::orderBy('created_at', 'desc')->get();

        // follows code start
        $user = auth()->user();
        $followers = $user->followers()->count();
        $following = $user->following()->count();


        $chat = User::with(['messages' => function ($query) {
            $query->select('from_user_id', DB::raw('MAX(created_at) as last_message_time'))
                ->groupBy('from_user_id');
        }])
        ->withCount('unreadMessages')
        ->take(20)
        ->get();
    
        // Fetch the last message and its time for each profile
        foreach ($topProfiles as $profile) {
            $lastMessage = Message::where('from_user_id', $profile->id)
                ->orWhere('to_user_id', $profile->id)
                ->orderBy('created_at', 'desc')
                ->first();
    
            $profile->last_message = $lastMessage->message;
            $profile->last_message_time = $lastMessage->created_at;
        }

        
    return view('dashboard', compact( 'posts','data','topProfiles','firstPost','followers','following','user','chat'));
    }
//     public function dashboard(Request $request, $id)
// {
//     $topProfiles = User::take(20)->get();
//     $posts = Project_post::orderBy('created_at','desc')->get();
//     $firstPost = Project_post::orderBy('created_at','desc')->first();
//     $data = Post::orderBy('created_at', 'desc')->get();

//     $user = auth()->user();
//     $followers = $user->followers()->count();
//     $following = $user->following()->count();

//     $recipient = User::find($id);

//     return view('dashboard', compact('posts', 'data', 'topProfiles', 'firstPost', 'followers', 'following', 'user', 'recipient'));
// }



    // <!-- User search function -->
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::where('first_name', 'like', "%$searchTerm%")
                        ->orWhere('department_id', 'like', "%$searchTerm%")
                        ->orWhere('semester', 'like', "%$searchTerm%")
                        ->get();
    // dd($results);
        return view('admin.allStudents',compact('users'));
    }


    public function __construct()
    {
        $this->middleware('auth');
    }


    // <!-- Post like function -->
    public function like(Request $request)
    {
        $project_post_id = $request->input('project_post');
        $project_post = Project_Post::find($project_post_id);

        if (!$project_post) {
            abort(404);
        }

        $user = auth()->user();
        $existing_like = $project_post->likes()->where('user_id', $user->id)->first();

        if ($existing_like) {
            // User has already liked the post, do not create a new like
            $existing_like->delete();
            $likes_count = $project_post->likes->count();
        } else {
            // User has not liked the post, create a new like
            $user->likes()->create([
                'project_post_id' => $project_post->id,
            ]);
            $likes_count = $project_post->likes->count();
        }

        return response()->json(['likes_count' => $likes_count]);
    }



    // <!-- post comment -->
    public function comment(Request $request)
    {
        $project_post_id = $request->input('project_post');
        $project_post = Project_Post::find($project_post_id);

        if (!$project_post) {
            abort(404);
        }
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $project_post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
            'project_post_id' => $project_post->id, // set the project_post_id column
        ]);
        return response()->json(['comments_count'=>$project_post->comments->count()]);

    }


    // <!-- View User profile -->
    public function showProfile($id){
        $user = User::find($id);
        $posts = Project_Post::where('user_id',$id)->get();
        $messages = [];
        if (auth()->user()) {
            $messages = $user->messages()->where('from_user_id', auth()->id())->orWhere('to_user_id', auth()->id())->latest()->limit(10)->get();

            // $messages = auth()->user()->messages()->where('to_user_id', $id)->latest()->take(10)->get()->reverse();
        }
        if (!$user) {
            abort(404);
        }
        $followers = $user->followers()->count();
        $following = $user->following()->count();
        $is_following = auth()->user() && auth()->user()->following->contains($user);
        return view('profile', compact('user', 'posts', 'followers', 'following', 'is_following', 'messages'));
    }


    // <!-- User follow -->
    public function follow($id)
    {
        $user = auth()->user();
        $following = User::find($id);
        if (!$following) {
            abort(404); // or handle the error in some other way
        }
        // check if the user is already following the profile
        if ($user->following->contains($following)) {
            return redirect()->back(); // or show a message indicating that the user is already following the profile
        }
        $user->following()->attach($following->id);
        $followers = $following->followers->count();
        return response()->json(['followers' => $followers]);
    }
    // <!-- user unfollow function -->
    public function unfollow($id)
    {
        
        $user = auth()->user();
        $following = User::find($id);
        if (!$following) {
            abort(404); // or handle the error in some other way
        }
        // check if the user is not following the profile
        if (!$user->following->contains($following)) {
            return response()->json(['followers' => 0]);
            //return redirect()->back(); // or show a message indicating that the user is not following the profile
        }
        $user->following()->detach($following->id);
        $followers = $following->followers->count();
        return response()->json(['followers' => $followers]);
    }


    // <!-- User send message -->
    // public function sendMessage(Request $request, $id)
    // {
    //     $user = auth()->user();
    //     $recipient = User::find($id);
    //     $message = new Message;
    //     $message->from_user_id = $user->id;
    //     $message->to_user_id = $recipient->id;
    //     $message->message = $request->input('message');
    //     $message->save();
    //     return redirect()->back();
    // }

    
    public function sendMessage(Request $request)
        {
           dd('helo');
            $chat = User::with(['messages' => function ($query) {
                $query->select('from_user_id', DB::raw('MAX(created_at) as last_message_time'))
                    ->groupBy('from_user_id');
            }])
            ->withCount('unreadMessages')
            ->take(20)
            ->get();
        
            // Fetch the last message and its time for each profile
            foreach ($topProfiles as $profile) {
                $lastMessage = Message::where('from_user_id', $profile->id)
                    ->orWhere('to_user_id', $profile->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
        
                $profile->last_message = $lastMessage->message;
                $profile->last_message_time = $lastMessage->created_at;
            }
        
            return redirect(route('dashboard'), compact('chat'));
        }
        
    


















    
}


