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

	<main>
		<div class="main-section">
			<div class="container">
				<div class="main-section-data">
					<div class="row">
						<div class="col-lg-3 col-md-4 pd-left-none no-pd">
							<div class="main-left-sidebar no-margin">
								<div class="user-data full-width">
									<div class="user-profile">
										<div class="username-dt">
											<div class="usr-pic">
												<img src="{{asset('uploads')}}/{{ auth()->user()->user_image}}" alt="" width="170" height="120">
											</div>
										</div><!--username-dt end-->
										<div class="user-specs">
											<h3> {{ auth()->user()->name }}</h3>
											<span>{{auth()->user()->department_id}}</span>
										</div>
										</div><!--user-profile end-->
										<ul class="user-fw-status">
											<li>
												<div >
													<h4>Followers</h4>
													<span>{{ $followers }}</span>
												</div>
											</li>
											<li>
												<div>
													<h4>Following</h4>
													<span>{{ $following }}</span>
												</div>
											</li>
											<li>
												{{-- <a href="{{url('testing')}}" title="">View Profile</a> --}}
												@foreach ($topProfiles as $profile)
												@if ($profile->id == Auth::user()->id)
													<a href="{{ route('user_profile', ['id' => $profile->id]) }}" title="">View Profile</a>
												@endif
												@endforeach
											</li>
										</ul>
									</div><!--user-data end-->

									<div class="suggestions full-width"><!--suggestions List Start-->
										<div class="sd-title">
											<h3>Suggestions</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
											<div class="suggestion-usd">
												@foreach ($topProfiles as $profile)
													<div class="suggestion-usd">											
														<div class="sgt-text" style="margin-right: 6%">
															<img src="{{asset('uploads')}}/{{$profile->user_image}}" alt="" width="35" height="35">
														</div>
														<h4>{{ $profile->name }}</h4>
														{{-- <span><a href="{{route('user_profile', ['id' => $profile->id]) }}" title="">View Profile</a></span> --}}
														<span style="margin-top: -7%"><a href="{{route('user_profile', ['id' => $profile->id]) }}" title=""><i class="la la-plus"></i></a></span>
														<div><span>{{ $profile->department_id }}</span></div>
													</div>
												@endforeach
											</div>
											<div class="view-more">
												<a href="#" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div><!--suggestions end-->


								</div><!--main-left-sidebar end-->
							</div>
							<div class="col-lg-6 col-md-8 no-pd">
								<div class="main-ws-sec">
									<div class="post-topbar">
										<div class="user-picy">
											<img src="images/LGU.png" alt="" height="50" width="50">
										</div>
										<div class="post-st">
											<ul>
												<li><a class="post_project" href="#" title="">Create a Post</a></li>
											</ul>
										</div><!--post-st end-->
									</div><!--post-topbar end-->
                                	<div class="posts-section">
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<img src="{{asset('uploads')}}/{{$firstPost->user->user_image}}" alt="" width="50" height="50">
													<div class="usy-name">
														<span> {{ $firstPost->user->name }}</span>
														<span><img src="images/clock.png" alt=""><p>{{ date('D H A', strtotime($firstPost->created_at)) }}</p></span>
													</div>
												</div>
												@if (auth()->user()->id== $firstPost->user_id)
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
													<li><a class="edit-post-btn" href="#" data-post-id="{{$firstPost->id}}" title="">Edit Post</a></li>
													<li><a class="delete-post-btn" href="#" data-post-id="{{ $firstPost->id }}">Delete</a></li>
													</ul>
												</div>
												@endif
											</div>
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="images/icon8.png" alt=""><span>LGU</span></li>
													<li><img src="images/icon9.png" alt=""><span>Pakistan</span></li>
												</ul>
												<ul class="bk-links">
													<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
													<li><a href="{{ route('chatify') }}" title=""><i class="la la-envelope"></i></a></li>
												</ul>
											</div>
											<div class="job_descp">
												<h3>{{$firstPost->project_title}}</h3>
												<ul class="job-dt">
													<li><a href="#" title="">{{$firstPost->department}}</a></li>
													<li><span>{{$firstPost->project_name}}</span></li>
												</ul>
												<p>{{$firstPost->project_description}}</p>
														<div class="sgt-text" style="margin-right: 6%">
															@if($firstPost->project_file && (pathinfo($firstPost->project_file, PATHINFO_EXTENSION) === 'jpg' || pathinfo($firstPost->project_file, PATHINFO_EXTENSION) === 'png'))
																<img src="{{ asset('uploads/'.$firstPost->project_file) }}" alt="" width="480px" height="400px">
															@elseif($firstPost->project_file && (pathinfo($firstPost->project_file, PATHINFO_EXTENSION) === 'mp4' || pathinfo($firstPost->project_file, PATHINFO_EXTENSION) === 'mov'))
																<video width="480px" height="400px" controls>
																	<source src="{{ asset('uploads/'.$firstPost->project_file) }}" type="video/mp4">
																</video>
															@endif
														</div>
												{{-- <img src="{{asset('uploads')}}/{{$firstPost->project_file}}" width="300px" height="200px" alt="" /> --}}
                                            </div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
                                                        <div class="post-actions">
															<form class="like-form"  action="{{ route('like', ['project_post' => $firstPost->id]) }}" method="POST">
																@csrf
																<button type="submit" class="like-button {{ $firstPost->likes->where('user_id', auth()->id())->first() ? 'liked' : '' }}"><i class="la la-heart"></i> Like</button>
															</form>
															<p class="like_count">{{ $firstPost->likes->count() }} likes</p>
    													</div>
													</li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
													<li>
														<div class="post-comment">
															<form class="comment-form" action="{{ route('comment', ['project_post' => $firstPost->id]) }}" method="POST">
																@csrf
																<input type="text" name="comment">
																<button type="submit">Comment</button>
															</form>
															<p class="comment_count" style="margin-bottom:1rem;">{{ $firstPost->comments->count() }} <button class="show-comments-link" href="#" data-post-id="{{ $firstPost->id }}">Comments</button></p>
															<div class="comments-container" style="display: none;">
																<div class="comments-row">
																	@foreach($firstPost->comments as $comment)
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
																							
												<a><i class="la la-eye"></i> Views <span id="view-count">{{ $post->views_count ?? 0 }}</span></a>



												{{-- <a><i class="la la-eye"></i>Views 50</a> --}}
											</div>
										</div><!--post-bar end-->
										<div class="top-profiles">
											<div class="pf-hd">
												<h3>Top Profiles</h3>
												<i class="la la-ellipsis-v"></i>
											</div>

											<div class="profiles-slider">
												@foreach ($topProfiles as $profile)
													<div class="user-profy">
															<img src="{{asset('uploads')}}/{{$profile->user_image}}" alt="" width="57" height="57">
															<h3>{{ $profile->name }}</h3>
															<span>{{ $profile->department_id }}</span>
															<ul>
																<li><a href="#" title="" class="followw">Follow</a></li>
																<li><a href="#" title="" class="envlp"><img src="images/envelop.png" alt=""></a></li>

															</ul>
															<a href="{{route('user_profile', ['id' => $profile->id]) }}" title="">View Profile</a>
													</div><!--user-profy end-->
												@endforeach
											</div><!--profiles-slider end-->
										</div><!--top-profiles end-->
									</div><!--posts-section end-->
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
												@if (auth()->user()->id== $post->user_id)

												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a class="edit-post-btn" href="#" data-post-id="{{$post->id}}" title="">Edit Post</a></li>
														<li><a class="delete-post-btn" href="#" data-post-id="{{ $post->id }}">Delete</a></li>
													</ul>
												</div>
												@endif

											</div>
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="images/icon8.png" alt=""><span>LGU</span></li>
													<li><img src="images/icon9.png" alt=""><span>Pakistan</span></li>
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
												<div class="sgt-text" style="margin-right: 6%">
													@if($post->project_file && (pathinfo($post->project_file, PATHINFO_EXTENSION) === 'jpg' || pathinfo($post->project_file, PATHINFO_EXTENSION) === 'png'))
														<img src="{{ asset('uploads/'.$post->project_file) }}" alt="" width="480px" height="400px">
													@elseif($post->project_file && (pathinfo($post->project_file, PATHINFO_EXTENSION) === 'mp4' || pathinfo($post->project_file, PATHINFO_EXTENSION) === 'mov'))
														<video width="480px" height="400px" controls>
															<source src="{{ asset('uploads/'.$post->project_file) }}" type="video/mp4">
														</video>
													@endif
												</div>
												{{-- <img src="{{asset('uploads')}}/{{$post->project_file}}" width="300px" height="200px" alt="" /> --}}
                                            </div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<div class="post-actions">
															<form class="like-form" action="{{ route('like', ['project_post' => $post->id]) }}" method="POST">
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
									@endif
                                    @endforeach
								</div><!--main-ws-sec end-->
							</div>
							<div class="col-lg-3 pd-right-none no-pd">
								<div class="right-sidebar">
                                    <div class="widget widget-about">
                                        <img src="images/LGU.png" alt="" height="150" width="130" style="margin-top: 9%">
                                        <div class="sign_link">
											<a href="https://lgu.edu.pk/" target="_blank" title=""><h1> Center for Teaching and Learning </h1></a>
										</div>
									</div><!--widget-about end-->
									<div class="widget suggestions full-width">
										<div class="sd-title">
											<h3>Most Viewed People</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
											<div class="suggestion-usd">
												@foreach ($topProfiles as $profile)
													<div class="suggestion-usd">
														<div class="sgt-text" style="margin-right: 6%">
															<img src="{{asset('uploads')}}/{{$profile->user_image}}" alt="" width="35" height="35">
														</div>
														<h4>{{ $profile->name }}</h4>
														{{-- <span><a href="{{route('user_profile', ['id' => $profile->id]) }}" title="">View Profile</a></span> --}}
														<span style="margin-top: -7%"><a href="{{route('user_profile', ['id' => $profile->id]) }}" title=""><i class="la la-plus"></i></a></span>
														<div><span>{{ $profile->department_id }}</span></div>
													</div>
												@endforeach
											</div>
											<div class="view-more">
												<a href="#" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div>
									{{-- <div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Top Posts</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="jobs-list">
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Product Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>BSCS</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior UI / UX Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>BSSE</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Junior Seo Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>BSCS</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior PHP Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>BSIT</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Developer Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>BSSE</span>
												</div>
											</div><!--job-info end-->
										</div><!--jobs-list end-->
									</div><!--widget-jobs end--> --}}
								</div><!--right-sidebar end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div>
			</div>
		</main>
		<div class="post-popup pst-pj">
			<div class="post-project">
				<h3>Create a project Post</h3>
				<div class="post-project-fields">
					<form id="project-form" action="{{route('project_post')}}" method="POST" enctype="multipart/form-data">
					{{-- <form action="{{route('project_post')}}" method="POST" enctype="multipart/form-data"> --}}
                        @csrf
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="project_title" placeholder="Post Title">
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select name="department">
										<option>Department</option>
										<option>BSCS</option>
										<option>BSIT</option>
										<option>BSSE</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<input type="text" name="project_name" placeholder="Topic">
                                @error('project_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
							</div>
							<div class="col-lg-12">
								<input type="file" name="project_file" accept="image/*, video/*" placeholder="File Upload">
								@error('project_file')
									<span class="error">{{ $message }}</span>
								@enderror
							</div>
							
							{{-- <div class="col-lg-12">
								<input type="file" name="project_file" placeholder="file Upload">
                                @error('project_file')
                                    <span class="error">{{ $message }}</span>
                                @enderror
							</div> --}}
							<div class="col-lg-12">
								<textarea name="project_description" placeholder="Post Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" id="submit-btn" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
								
								{{-- <ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul> --}}
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		<!-- Edit post popup -->
		<div id="edit-post-popup" class="post-popup job_post">
			<div class="post-project">
				<h3>Edit a Post</h3>
				<div class="post-project-fields">
					<form id="edit-post-form" method="post" action="{{ route('edit_post', ['id' => ':postId']) }}" enctype="multipart/form-data">
						@csrf
						@method('post')
						<div class="row">
							<div class="col-lg-12">
								<input id="edit_project_title" type="text" name="project_title" placeholder="Title">
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select name="department" id="edit_department">
										<option>Department</option>
										<option value="BSCS">BSCS</option>
										<option value="BSIT">BSIT</option>
										<option value="BSSE">BSSE</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<input type="text" id="edit_project_name" name="project_name" placeholder="Subject">
							</div><div class="col-lg-12">
								<input type="file" name="project_file" id="edit_project_file" accept="image/*, video/*" placeholder="File Upload">
								@error('project_file')
									<span class="error">{{ $message }}</span>
								@enderror
							</div>
							{{-- <div class="col-lg-12">
								<input type="file" id="edit_project_file" name="project_file" placeholder="Image" >
							</div> --}}
							<div class="col-lg-12">
								<textarea id="edit_project_description" name="project_description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="edit">Edit</button></li>
									{{-- <li><a href="#" title="">Cancel</a></li> --}}
									<li><a href="#" id="cancel-edit-btn" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->
		<!-- Add an input field to store the post ID -->
		<input type="hidden" id="edit_post_id" name="post_id">

		<script>
			// Get the edit post button elements
			const editPostButtons = document.querySelectorAll('.edit-post-btn');
			// Add click event listeners to each edit post button
			editPostButtons.forEach(button => {
				button.addEventListener('click', () => {
					const postId = button.getAttribute('data-post-id');
					fetchPostData(postId);
				});
			});

			// Fetch post data based on the post ID
			function fetchPostData(postId) {
				fetch(`/posts/${postId}`)
					.then(response => response.json())
					.then(data => {
						$('#edit_post_id').val(postId);
						$('#edit_project_title').val(data.project_title);
						$('#edit_project_name').val(data.project_name);
						$('#edit_department').val(data.department);
						$('#edit_project_description').val(data.project_description);
						openEditPopup();
					})
					.catch(error => {
						console.error('Error:', error);
					});
			}

			// Populate the edit post form with the fetched data
			function openEditPopup() {
				const editPostPopup = document.querySelector('#edit-post-popup');
				editPostPopup.classList.add('active');
				editPostPopup.style.display = 'block';
			}

			// Handle form submission
			document.getElementById('edit-post-form').addEventListener('submit', function (e) {
				e.preventDefault(); // Prevent default form submission

				// Get the form data
				const formData = new FormData(this);

				// Get the post ID
				const postId = $('#edit_post_id').val();

				// Perform the AJAX update
				updatePost(postId, formData);
			});

			// Update the post via AJAX
			function updatePost(postId, formData) {
				fetch(`/edit_post/${postId}`, {
					method: 'POST',
					body: formData,
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					}
				})
					.then(response => {
						if (response.ok) {
							// Handle the successful update
							console.log('Post updated successfully');
							closeEditPopup(); // Close the popup after successful update
							location.reload(); // Refresh the page
						} else {
							// Handle the error case
							console.error('Error:', response.status);
						}
					})
					.catch(error => {
						console.error('Error:', error);
					});
			}

			// Close the edit popup
			function closeEditPopup() {
				const editPostPopup = document.querySelector('#edit-post-popup');
				editPostPopup.classList.remove('active');
				editPostPopup.style.display = 'none';
			}

			document.getElementById('cancel-edit-btn').addEventListener('click', () => {
				closeEditPopup();
			});

			// Get the delete post anchor elements
			const deletePostAnchors = document.querySelectorAll('.delete-post-btn');

			// Add click event listeners to each delete post anchor
			deletePostAnchors.forEach(anchor => {
				anchor.addEventListener('click', (event) => {
					event.preventDefault();
					const postId = anchor.getAttribute('data-post-id');
					deletePost(postId);
				});
			});

			// Function to delete a post
			function deletePost(postId) {
				if (confirm('Are you sure you want to delete this post?')) {
					fetch(`/delete_post/${postId}`, {
						method: 'DELETE',
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}',
							'Content-Type': 'application/json',
						},
					})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
								window.location.reload(); // Reload the current page
							}
						})
						.catch(error => {
							console.error('Error:', error);
						});
				}
			}

		</script>

		<!-- Chat box with user messages start div -->
	{{-- <div class="chatbox-list">
			<!-- Chat box with user messages -->
			<div class="chatbox">
				<div class="chat-mg bx">
					<a href="{{route('dashboard')}}" title=""><img src="images/chat.png" alt=""></a>
					<span>2</span>
				</div>
				<div class="conversation-box">
					<div class="con-title">
						<h3>Message</h3>
						<a href="#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
					</div>

					<!-- Chat box with user messages -->
					<div class="chat-box">
						<div class="chat-list">
							@foreach($chat as $message)
								<div class="conv-list" onclick="openMessageBox('{{ $message->from_user_name }}', '{{ $message->from_user_id }}')">
									<div class="usrr-pic">
										<img src="{{asset('uploads')}}/{{$message->from_user_image}}" width="50px" height="50px" alt="" />
										<span class="active-status activee"></span>
									</div>
									<div class="usy-info">
										<h3>{{ $message->from_user_name }}</h3>
										<span>{{ $message->message }}</span>
									</div>
									<div class="ct-time">
										<span>{{ $message->created_at }}</span>
									</div>
									<span class="msg-numbers">{{ $message->unread_messages }}</span>
								</div>
							@endforeach

						</div>
					</div>
				</div><!--conversation-box end-->
			</div>

			<!-- Message box (Initially hidden) -->
			<div class="message-box" style="display: none;">
				<div class="chatbox">
					<div class="chat-mg">
						<a href="#" title=""><img src="images/aaa.png" alt="" width="70" height="70"></a>
						<span>2</span>
					</div>
					<div class="conversation-box">
						<div class="con-title mg-3">
							<div class="chat-user-info">
								<img src="http://via.placeholder.com/34x33" alt="">
								<h3 id="messageBoxUsername"></h3>
								<span class="status-info"></span>
							</div>
							<div class="st-icons">
								<a href="#" title=""><i class="la la-cog"></i></a>
								<a href="#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
								<a href="#" title="" class="close-chat"><i class="la la-close"></i></a>
							</div>
						</div>
						<div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
							<!-- Message history content will be dynamically added here -->
						</div><!-- chat-hist end -->
						<div class="typing-msg">
							<form id="sendMessageForm" action="{{ route('send_message', $user->id) }}" method="POST">
								@csrf
								<textarea id="messageInput" placeholder="Type a message here" name="message"></textarea>
								<button type="submit" onclick="sendMessage(event)"><i class="fa fa-send"></i></button>
							</form>
							<ul class="ft-options">
								<li><a href="#" title=""><i class="la la-smile-o"></i></a></li>
								<li><a href="#" title=""><i class="la la-camera"></i></a></li>
								<li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
							</ul>
						</div><!-- typing-msg end -->
					</div><!-- conversation-box end -->
				</div><!-- chatbox end -->
			</div>

	</div><!--chat box with user message div end--> --}}

	<!--Project Post fill all fields Javascript-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#submit-btn').click(function(e) {
				e.preventDefault(); // Prevent the form from submitting normally
	
				// Check if any field is empty
				var isAnyFieldEmpty = false;
				$('#project-form input, #project-form select, #project-form textarea').each(function() {
					if ($(this).val() === '') {
						isAnyFieldEmpty = true;
						return false; // Exit the loop if any field is empty
					}
				});
	
				if (isAnyFieldEmpty) {
					// Not all fields are filled, show a message or alert
					alert('Please fill all fields before submitting.');
				} else {
					// All fields are filled, submit the form via AJAX
					var form = $('#project-form')[0];
					var formData = new FormData(form);
	
					$.ajax({
						url: form.action,
						method: form.method,
						data: formData,
						processData: false,
						contentType: false,
						success: function(response) {
							// Handle the success response here
							console.log(response);
							$('#post-popup').removeClass('active'); // Close the popup window
							location.reload(); // Refresh the page
						},
						error: function(xhr) {
							// Handle the error response here
							console.log(xhr.responseText);
						}
					});
				}
			});
		});
	</script>

	<!-- View count javascript -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		// Make an AJAX request to update the view count
		function updateViewCount(postId) {
			$.ajax({
				url: '/posts/' + postId,
				type: 'GET',
				success: function(response) {
					$('#view-count').text(response.views_count); // Update the view count in the HTML
				},
				error: function(xhr, status, error) {
					console.log(error); // Handle the error if needed
				}
			});
		}
		
		// Call the updateViewCount function with the post ID when the page loads
		$(document).ready(function() {
			var postId = {{ $post->id }};
			updateViewCount(postId);
		});
	</script>
	
	

		<!-- chat box javascript -->
		{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			function fetchUserConversations() {
			fetch("/get-user-conversations")
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						const chatList = document.querySelector(".chat-list");
						chatList.innerHTML = "";

						data.userConversations.forEach(conversation => {
							const convList = document.createElement("div");
							convList.className = "conv-list";
							convList.onclick = function() {
								openMessageBox(conversation.username, conversation.userId);
							};

                    convList.innerHTML = `
                        <div class="usrr-pic">
                            <img src="${conversation.userImage}" width="50px" height="50px" alt="" />
                            <span class="active-status activee"></span>
                        </div>
                        <div class="usy-info">
                            <h3>${conversation.username}</h3>
                            <span>${conversation.lastMessage}</span>
                        </div>
                        <div class="ct-time">
                            <span>${conversation.timestamp}</span>
                        </div>
                        <span class="msg-numbers">${conversation.unreadMessages}</span>
                    `;

                    chatList.appendChild(convList);
                });
            }
        	})
				.catch(error => {
					console.log(error);
				});
			}

			function fetchMessageHistory(userId) {
				fetch("/get-message-history/" + userId)
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							var messageHistory = document.querySelector(".chat-hist");
							messageHistory.innerHTML = "";

							var maxMessagesToShow = 16; // Maximum number of messages to show
							var slicedMessageHistory = data.messageHistory.slice(-maxMessagesToShow);

							slicedMessageHistory.forEach(message => {
								var messageContent = document.createElement("div");
								messageContent.className =
									message.from_user_id == userId
										? "message-content received-message"
										: "message-content sent-message";
								messageContent.textContent = message.message;

								messageHistory.appendChild(messageContent);
							});

							// Scroll to the bottom of the message history
							messageHistory.scrollTop = messageHistory.scrollHeight;
						}
					})
					.catch(error => {
						console.log(error);
					});
			}

			function openMessageBox(username, userId) {
				document.getElementById("messageBoxUsername").innerText = username;
				document.getElementById("sendMessageForm").action = "/dashboard/send-message/" + userId;

				document.querySelector(".message-box").style.display = "block";
				//document.querySelector(".chatbox").style.display = "none";


				// Call the fetchMessageHistory function to fetch and display the message history
				fetchMessageHistory(userId);

				// Start AJAX polling every 1 second to fetch and update the messages
				setInterval(() => {
					fetchMessageHistory(userId);
				}, 1000);
			}

			function sendMessage(event) {
				event.preventDefault();
				var message = document.getElementById("messageInput").value;
				if (message.trim() !== "") {
					// Submit the form using AJAX
					var form = document.getElementById("sendMessageForm");
					var formData = new FormData(form);

					fetch(form.action, {
						method: "POST",
						body: formData
					})
						.then(response => {
							if (response.ok) {
								// Clear the input field
								document.getElementById("messageInput").value = "";

								// Scroll to the bottom of the message history after sending a message
								var messageHistory = document.querySelector(".chat-hist");
								messageHistory.scrollTop = messageHistory.scrollHeight;
							}
						})
						.catch(error => {
							console.log(error);
						});
				}
			}

			function refreshChatBox() {
				fetchNewUserConversations();
			}


			function refreshChatBox() {
				fetchUserConversations();
				fetchNewUserConversations();
			}

			// Fetch and display all user conversations initially
			fetchUserConversations();

			// Fetch new user conversations every 3 seconds
			setInterval(fetchNewUserConversations, 3000);

			// Refresh chat box every 3-4 seconds
			setInterval(refreshChatBox, 3000);
		</script> --}}

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#department').change(function() {
                var departmentId = $(this).val();

                // Make an AJAX request to fetch related semester data
                $.ajax({
                    type: 'GET',
                    url: '/semesters/' + departmentId,
                    success: function(response) {
                        // Populate the semester select box with the fetched data
                        var options = '<option value="">Select Semester</option>';
                        $.each(JSON.parse(response), function(key, value) {
                            options += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        $('#semester').html(options).removeClass('hidden');
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




