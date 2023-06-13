
@extends('admin.layout')
@section('umt')
<style>

.like-button {
			color: black;
		}
		.like-button.liked {
			color: red;
		}
		.sent-message {
			background-color: #c6f3d8;
			text-align: right;
		}
		.received-message {
			background-color: #c8e0f0;
			text-align: left;
		}
		button.show-comments-link {
		border: none;
		background-color: transparent;
		color: inherit;
		padding: 0;
		font: inherit;
		cursor: pointer;
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

                      <div class="posts-section">
                        <div class="post-bar">
                          <div class="post_topbar">
                            <div class="usy-dt">
                              <img src="{{asset('uploads')}}/{{$post->user->user_image}}" alt="" width="50" height="50">
                              <div class="usy-name">
                                <span> {{ $post->user->name }}</span>
                                @if($post->image)
                                  <img src="{{asset('uploads')}}/{{$post->user_image}}" width="200px" height="200px" alt="" />
                                @endif
                                <span><img src="{{ asset('images/clock.png') }}" alt=""><p>{{ date('D H A', strtotime($post->created_at)) }}</p></span>
                              </div>
                            </div>

                          </div>
                          <div class="epi-sec">
                            <ul class="descp">
                              <li><img src="{{ asset('images/icon8.png') }}" alt=""><span>LGU</span></li>
                              <li><img src="{{ asset('images/icon9.png') }} " alt=""><span>Pakistan</span></li>
                            </ul>
                            <ul class="bk-links">
                              <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                              <li><a href="{{ route('chatify') }}" title=""><i class="la la-envelope"></i></a></li>
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
                                        <form class="like-form"  action="{{ route('like', ['project_post' => $post->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="like-button {{ $post->likes->where('user_id', auth()->id())->first() ? 'liked' : '' }}"><i class="la la-heart"></i> Like</button>
                                        </form>
                                        <p class="like_count">{{ $post->likes->count() }} likes</p>
                                    </div>
                                </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <li>
                                    <div class="post-comment">
                                        <form class="comment-form" action="{{ route('comment', ['project_post' => $post->id]) }}" method="POST">
                                            @csrf
                                            <input type="text" name="comment">
                                            <button type="submit">Comment</button>
                                        </form>
                                        <p class="comment_count" style="margin-bottom:1rem;">{{ $post->comments->count() }} <button class="show-comments-link" href="#" data-post-id="{{ $post->id }}">Comments</button></p>
                                        <div class="comments-container" style="display: none;">
                                            <div class="comments-row">
                                                @foreach($post->comments as $comment)
                                                    <div class="comment">
                                                        <p>
                                                            <span class="comment-user">{{ $comment->user->name }}:</span>
                                                            <span class="comment-text">{{ $comment->comment }}</span>
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <a><i class="la la-eye"></i>Views 50</a>
                        </div>

                        </div><!--post-bar end-->
                      </div><!--posts-section end-->

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




















      // Post Like Ajax
		$(document).ready(function() {
			$('.like-form').submit(function(event) {
				event.preventDefault(); // Prevent default form submission behavior
				var $form = $(this); // Save a reference to the form element
				var formData = $form.serialize(); // Serialize form data
				$.ajax({
					type: 'POST',
					url: $form.attr('action'), // Get the form's action attribute
					data: formData,
					success: function(response) {
						// Check if the count of likes has changed
						var $likeCount = $form.closest('.post-actions').find('.like_count');
						var currentCount = parseInt($likeCount.text());
						var newCount = parseInt(response.likes_count);
						if (newCount !== currentCount) {
							// Update the count of likes if it has changed
							$likeCount.text(newCount + ' likes');
						}
						// Toggle the 'liked' class on the like button
						var $likeButton = $form.find('.like-button');
						$likeButton.toggleClass('liked');
					}
				});
			});
		});



		// Ajax comments
		$(document).ready(function() {
			$('.comment-form').submit(function(event) {
				event.preventDefault(); // Prevent default form submission behavior
				var $form = $(this); // Save a reference to the form element
				var formData = $form.serialize(); // Serialize form data
				$.ajax({
					type: 'POST',
					url: $form.attr('action'), // Get the form's action attribute
					data: formData,
					success: function(response) {
						// Update comments count
						var count = response.comments_count;
						$form.closest('.post-comment').find('.comment_count').text(count + ' comments');
						$('.comment-form input[name="comment"]').val('');
					}
				});
			});

			$('.show-comments-link').click(function(e) {
					e.preventDefault();
					var postId = $(this).data('post-id');
					var $commentsContainer = $(this).closest('.post-comment').find('.comments-container');

					// Make an AJAX request to fetch the comments
					$.ajax({
						type: 'GET',
						url: '/comments/' + postId, // Replace with your actual route for fetching comments
						success: function(response) {
							$commentsContainer.empty(); // Clear existing comments

							// Iterate through the comments and append them to the container
							$.each(response.comments, function(index, comment) {
								var username = comment.user ? comment.user.name : 'Unknown User';
								var user_image = comment.user.user_image;
								var image_url = "{{asset('uploads')}}"+'/'+ user_image;
								var image = '<img src="' + image_url + '" width="30px" height="30px" alt="" />';
								var userimage = comment.user ?image : 'Unknown User';
								// var commentHtml = '<div class="comment"><p>' + username + ': ' + userimage + comment.comment + '</p><br></div>';
								var commentHtml = '<div class="comment"><h3>' + userimage + username + '</h3><p style="margin-bottom:1rem;">'  + comment.comment + '</p><br></div>';

								$commentsContainer.append(commentHtml);
							});

							$commentsContainer.show(); // Show the comments container
						}
					});
				});
		});

    </script>

@endsection

