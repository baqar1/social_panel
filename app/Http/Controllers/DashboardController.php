<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // <!-- Create a post function -->
    public function project_post(Request $request){
        $this->validate($request,[
            'project_title'=>'required',
            'project_file'=>'required',
         ]);
         if($request->has('project_file')){
            $image = $request->file('project_file');

            $imageName = time().'.'.$request->file('project_file')->extension();
            $image->move(public_path('uploads'), $imageName);
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


        // <!-- Update a post function -->
    public function updatePost(Request $request, $id){
        $projectPost = project_post::findOrFail($id);

        $validatedData = $request->validate([
            'project_title' => 'required|string',
            'project_name' => 'required|string',
            'department' => 'required|string',
            'project_description' => 'required|string',
            'project_file' => 'nullable|image', // Validate that it is an image file (optional)
        ]);
        // Update the post data based on the request input
        $projectPost->project_title = $request->input('project_title');
        $projectPost->project_name = $request->input('project_name');
        $projectPost->department = $request->input('department');
        $projectPost->project_description = $request->input('project_description');

        if($request->has('project_file')){
            // dd($request->file('project_file'));
            $imageName = time().'.'.$request->file('project_file')->getClientOriginalName();
            $request->file('project_file')->storeAs('uploads', $imageName, 'public');
        }
        $projectPost->project_file = $imageName;
        // Save the updated post
        $projectPost->save();

        return response()->json(['message' => 'Post updated successfully']);
    }



        // <!-- Edit a post function -->
    public function getProjectPost($id){
        $projectPost = project_post::findOrFail($id);

        return response()->json($projectPost);
    }

    public function deletePost(Request $request, $id){
        // Find the post to delete
        $projectPost = project_post::findOrFail($id);

        // Delete the post
        $projectPost->delete();

        return response()->json(['success' => true, 'message' => 'Post deleted successfully']);
    }


        // <!-- Dahboard page all view function -->
    public function dashboard(Request $request){
        $topProfiles = User::take(20)->get();
        $posts = Project_post::orderBy('created_at', 'desc')->get();
        $firstPost = Project_post::orderBy('created_at', 'desc')->first();
        $data = Post::orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        $followers = $user->followers()->count();
        $following = $user->following()->count();
        $projectPosts = project_post::all();
        // Chat/Message box code
        $chat = DB::table('users')
        ->leftJoin('messages', function ($join) use ($user) {
            $join->on('users.id', '=', 'messages.from_user_id')
                ->where('messages.created_at', '=', function ($query) use ($user) {
                    $query->selectRaw('MAX(created_at)')
                        ->from('messages')
                        ->whereRaw('(from_user_id = users.id AND to_user_id = ?) OR (from_user_id = ? AND to_user_id = users.id)', [$user->id, $user->id]);
                });
        })
        ->leftJoin('messages as m', function ($join) {
            $join->on(function ($query) {
                $query->on('m.from_user_id', '=', 'users.id')
                    ->on('m.to_user_id', '=', 'messages.to_user_id');
            })
            ->orWhere(function ($query) {
                $query->on('m.from_user_id', '=', 'messages.from_user_id')
                    ->on('m.to_user_id', '=', 'users.id');
            })
            ->on('m.created_at', '>', 'messages.created_at')
            ->whereNull('m.read_at');
        })
        ->select(
            'users.id as from_user_id',
            'users.name as from_user_name',
            'users.user_image as from_user_image',
            'messages.message',
            'messages.created_at',
            'messages.read_at',
            DB::raw('COUNT(m.id) as unread_messages')
        )
        ->where(function ($query) use ($user) {
            $query->where('messages.to_user_id', $user->id)
                ->orWhere('messages.from_user_id', $user->id);
        })
        ->groupBy('users.id', 'from_user_id', 'users.name', 'user_image', 'messages.message', 'messages.created_at', 'messages.read_at')
        ->orderByDesc('messages.created_at')
        ->get();

        return view('dashboard', compact('posts', 'data', 'topProfiles', 'firstPost','projectPosts', 'followers', 'following', 'user', 'chat'));
    }



    // <!-- User search function -->
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::where('name', 'like', "%$searchTerm%")
                        ->orWhere('department_id', 'like', "%$searchTerm%")
                        ->orWhere('semester', 'like', "%$searchTerm%")
                        ->get();
        return view('admin.allStudents',compact('users'));
    }


    public function __construct()
    {
        $this->middleware('auth');
    }


    // <!-- Post like function -->
    public function like(Request $request){
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



    // <!-- post comment & Get Comment-->
    public function comment(Request $request){
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
    public function getComments($project_post_id)
    {
        $project_post = Project_Post::findOrFail($project_post_id);
        $comments = $project_post->comments()->with('user')->get();

        return response()->json(['comments' => $comments]);
    }



    // <!-- View User profile -->
    public function showProfile($id){
        $user = User::find($id);
        $posts = Project_Post::where('user_id',$id)->get();

        $followers = $user->followers()->count();
        $following = $user->following()->count();
        $is_following = auth()->user() && auth()->user()->following->contains($user);
        return view('profile', compact('user', 'posts', 'followers', 'following', 'is_following'));
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


        // <!-- getconversation chat list function -->
    public function getConversation($userId)
    {
        // Get the logged-in user
        $loggedInUser = Auth::user();

        // Get the other user (conversation partner)
        $otherUser = User::findOrFail($userId);

        // Get all conversations between the logged-in user and the other user
        $conversation = Message::where(function ($query) use ($loggedInUser, $otherUser) {
                $query->where('from_user_id', $loggedInUser->id)
                    ->where('to_user_id', $otherUser->id);
            })
            ->orWhere(function ($query) use ($loggedInUser, $otherUser) {
                $query->where('from_user_id', $otherUser->id)
                    ->where('to_user_id', $loggedInUser->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Mark all messages from the other user as read
        Message::where('from_user_id', $otherUser->id)
            ->where('to_user_id', $loggedInUser->id)
            ->where('read', 0)
            ->update(['read' => 1]);

        return response()->json(['conversation' => $conversation, 'otherUser' => $otherUser]);
    }



        // <!-- Send message in dashboard function -->
    public function sendMessage($userId, Request $request){

        // Get the logged-in user
        $loggedInUser = Auth::user();

        // Get the recipient user
        $recipientUser = User::findOrFail($userId);

        // Create a new message
        $message = new Message();
        $message->from_user_id = $loggedInUser->id;
        $message->to_user_id = $recipientUser->id;
        $message->message = $request->input('message');
        $message->save();

        // Return a simple HTTP response without content
        return response('', 204);
    }


        // <!-- Get all Message history in dashboard function -->
    public function getMessageHistory($userId){
        // Get the logged-in user
        $loggedInUser = Auth::user();

        // Get the other user (conversation partner)
        $otherUser = User::findOrFail($userId);

        // Get the message history between the logged-in user and the other user
        $messageHistory = Message::whereIn('from_user_id', [$loggedInUser->id, $otherUser->id])
            ->whereIn('to_user_id', [$loggedInUser->id, $otherUser->id])
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['success' => true, 'messageHistory' => $messageHistory]);
    }




}


