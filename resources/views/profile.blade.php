
@extends('admin.layout')
@section('umt')
<style>
  .message-box {
  display: inline-block;
  max-width: 80%;
  padding: 8px 12px;
  border-radius: 16px;
  margin: 4px;
  font-size: 14px;
}

.message-box.sent {
  background-color: #DCF8C6;
  float: right;
}

.message-box.received {
  background-color: #dfe8f7;
  float: left;
}

</style>


    <div class="container py-4">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            @if ($user)
                <div class="usr-pic" style="margin-left: 8%;margin-top: 6%">
                    <img src="{{asset('uploads')}}/{{ $user->user_image}}" alt="" width="170" height="120">
                </div>
                <div class="card-body text-center">
                      <h1 class="card-title mb-0">{{$user->name}}</h1><br>
                </div>
            @else
                <p>User not found.</p>
            @endif
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                  <div class="d-flex justify-content-between">
                      <span>Followers</span>
                      <span id='follower_count'>{{ $followers }}</span>
                  </div>
              </li>
              <li class="list-group-item">
                  <div class="d-flex justify-content-between">
                      <span>Following</span>
                      <span>{{ $following }}</span>
                  </div>
              </li>
            </ul>
          <div class="card-footer">
            @if (auth()->user() && auth()->user()->id !== $user->id)
                @if (auth()->user()->following->contains($user))
                    <button class="btn btn-danger unfollow-btn" data-user-id="{{ $user->id }}">Unfollow</button>
                @else
                    <button class="btn btn-primary follow-btn" data-user-id="{{ $user->id }}">Follow</button>
                @endif
            @endif
          </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Posts</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  @foreach ($posts as $key=>$post)
                      @if ($key>0)
                      <div class="posts-section">
                        <div class="post-bar">
                          <div class="post_topbar">
                            <div class="usy-dt">
                              {{-- <img src="http://via.placeholder.com/50x50" alt=""> --}}
                              <img src="{{asset('uploads')}}/{{$post->user->user_image}}" alt="" width="50" height="50">
                              <div class="usy-name">
                                <span> {{ $post->user->name }}</span>
                                {{-- <h3>{{$post->project_title}}</h3> --}}
                                @if($post->image)
                                  <img src="{{asset('uploads')}}/{{$post->user_image}}" width="200px" height="200px" alt="" />
                                @endif
                                <span><img src="images/clock.png" alt=""><p>{{ date('D H A', strtotime($post->created_at)) }}</p></span>
                              </div>
                            </div>
                            <div class="ed-opts">
                              <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                              <ul class="ed-options">
                                <li><a href="#" title="">Edit Post</a></li>
                                <li><a href="#" title="">Unsaved</a></li>
                                <li><a href="#" title="">Unbid</a></li>
                                <li><a href="#" title="">Close</a></li>
                                <li><a href="#" title="">Hide</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="epi-sec">
                            <ul class="descp">
                              <li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
                              <li><img src="images/icon9.png" alt=""><span>Pakistan</span></li>
                            </ul>
                            <ul class="bk-links">
                              <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                              <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                            </ul>
                          </div>
                          <div class="job_descp">
                            <h3>{{$post->project_title}}</h3>
                            <ul class="job-dt">
                              <li><a href="#" title="">{{$post->department}}</a></li>
                              <li><span>{{$post->project_name}}</span></li>
                            </ul>

                            <p>{{$post->project_description}}</p>
                            <img src="{{asset('uploads')}}/{{$post->project_file}}" width="300px" height="200px" alt="" />
                          </div>
                          <div class="job-status-bar">
                            <ul class="like-com">
                              <li>
                                <div class="post-actions">
                                  <form class="like-form" action="{{ route('like', ['project_post' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"><i class="la la-heart" style="color: red"></i> Like</button>
                                  </form>
                                  <p class="like_count">{{ $post->likes->count() }} likes</p>
                                </div>
                              </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              <li><div class="post-comment">
                                <form class="comment-form" action="{{ route('comment', ['project_post' => $post->id]) }}" method="POST">
                                  @csrf
                                  <input type="text" name="comment">
                                  <button type="submit">Comment</button>
                                  </form>
                                  <p class="comment_count">{{ $post->comments->count() }} comments</p>
                                </div>
                              </li>
                            </ul>
                            <a><i class="la la-eye"></i>Views 50</a>
                          </div>

                        </div><!--post-bar end-->
                      </div><!--posts-section end-->
                      @endif
                  @endforeach
								</div><!--main-ws-sec end-->
              </div>
              </div>
            </div>
          </div>
        </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
          // Follow button click handler
          $(document).on('click','.follow-btn',function() {
              var userId = $(this).data('user-id');
              console.log(userId);
              $.ajax({
                  url: '/follow/' + userId,
                  type: 'POST',
                  data: {
                      _token: '{{ csrf_token() }}',
                      following_id: userId
                  },
                  success: function(response) {
                      // Update the button text and class
                      $('.follow-btn[data-user-id="' + userId + '"]')
                          .removeClass('follow-btn')
                          .addClass('unfollow-btn')
                          .removeClass('btn-primary')
                          .addClass('btn-danger')
                          .text('Unfollow');

                      // Update the followers count
                      console.log(response.followers);
                      $('#follower_count').html(response.followers);
                      // $('.followers-count').text(response.followers);
                  }
              });
          });

          // Unfollow button click handler
          $(document).on('click','.unfollow-btn',function() {
              var userId = $(this).data('user-id');
              console.log(userId);
              $.ajax({
                  url: '/unfollow/' + userId,
                  type: 'DELETE',
                  data: {
                      _token: '{{ csrf_token() }}',
                      following_id: userId
                  },
                  success: function(response) {
                    $('.unfollow-btn[data-user-id="' + userId + '"]')
                        .removeClass('unfollow-btn')
                          .addClass('follow-btn')
                          .removeClass('btn-danger')
                          .addClass('btn-primary')
                          .text('Follow');
                          console.log(response.followers);

                      // Update the followers count
                      $('#follower_count').html(response.followers);
                  }
              });
          });
      });
    </script>

@endsection

