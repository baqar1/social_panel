
@extends('admin.layout')
@section('umt')
<style>
    .profile-image {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        margin-left: 30%;
    }
    .profile-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

	

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

		<section class="companies-info">
			<div class="container">
				<div class="company-title">
					<h3>All Students</h3>
				</div><!--company-title end-->

				<div class="companies-list">
					<div class="row">
						@foreach ($users as $user)
							<div class="col-lg-3 col-md-4 col-sm-6"><br>
								<div class="user-profy">
									<div class="profile-image">
										<img src="{{asset('uploads')}}/{{$user->user_image}}" alt="" width="90" height="90"><br>
									</div><br>
										<h3>{{ $user->name }}</h3>
										<span>{{ $user->department_id }}</span><br>
										<ul>
											<li>
												<div>
													@if (auth()->user() && auth()->user()->id !== $user->id)
														@if (auth()->user()->following->contains($user))
															<button class="btn btn-danger unfollow-btn" data-user-id="{{ $user->id }}">Unfollow</button>
														@else
															<button class="btn btn-primary follow-btn" data-user-id="{{ $user->id }}">Follow</button>
														@endif
													@endif
												  </div>
												{{-- <a href="#" title="" class="followw">Follow</a> --}}
											</li>
											{{-- <li><a href="#" title="" class="envlp"><img src="images/envelop.png" alt=""></a></li> --}}

										</ul><br><br>
										<br><a href="{{route('user_profile', ['id' => $user->id]) }}" title="">View Profile</a>
								</div><!--user-profy end-->
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</section><!--companies-info end-->
	</div><!--theme-layout end-->

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
