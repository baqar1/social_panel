@extends('admin.layout')
@section('zee')
	<style>
		.like-button {
			color: black;
		}
		.like-button.liked {
			color: red;
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
													<img src="{{asset('storage/uploads')}}/{{ auth()->user()->user_image}}" alt="" width="170" height="120">
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<h3> {{ auth()->user()->first_name }}</h3>
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
									<div class="suggestions full-width">
										<div class="sd-title">
											<h3>Suggestions</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>John Doe</h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Poonam</h4>
													<span>Wordpress Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Bill Gates</h4>
													<span>C & C++ Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>John Doe</h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="view-more">
												<a href="#" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div><!--suggestions end-->
									<div class="tags-sec full-width">
										<ul>
											<li><a href="#" title="">Help Center</a></li>
											<li><a href="#" title="">About</a></li>
											<li><a href="#" title="">Privacy Policy</a></li>
											<li><a href="#" title="">Community Guidelines</a></li>
											<li><a href="#" title="">Cookies Policy</a></li>
											<li><a href="#" title="">Career</a></li>
											<li><a href="#" title="">Language</a></li>
											<li><a href="#" title="">Copyright Policy</a></li>
										</ul>
										<div class="cp-sec">
											<img src="images/logo2.png" alt="">
											<p><img src="images/cp.png" alt="">Copyright 2018</p>
										</div>
									</div><!--tags-sec end-->
								</div><!--main-left-sidebar end-->
							</div>
							<div class="col-lg-6 col-md-8 no-pd">
								<div class="main-ws-sec">
									<div class="post-topbar">
										<div class="user-picy">
											<img src="images/umttt.png" alt="" height="50" width="50">
										</div>
										<div class="post-st">
											<ul>
												<li><a class="post_project" href="#" title="">Create a Project Post</a></li>
												<li><a class="post-jb active" href="#" title="">Create a Post</a></li>
											</ul>
										</div><!--post-st end-->
									</div><!--post-topbar end-->
                                	<div class="posts-section">
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<img src="{{asset('storage/uploads')}}/{{$firstPost->user->user_image}}" alt="" width="50" height="50">
													<div class="usy-name">
														<span> {{ $firstPost->user->first_name }}</span>
														<span><img src="images/clock.png" alt=""><p>{{ date('D H A', strtotime($firstPost->created_at)) }}</p></span>
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
												<h3>{{$firstPost->project_title}}</h3>
												<ul class="job-dt">
													<li><a href="#" title="">{{$firstPost->department}}</a></li>
													<li><span>{{$firstPost->project_name}}</span></li>
												</ul>

												<p>{{$firstPost->project_description}}</p>
											
                                            	<img src="{{asset('storage/uploads')}}/{{$firstPost->project_file}}" width="300px" height="200px" alt="" />
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
														  <p class="comment_count">{{ $firstPost->comments->count() }} comments</p>
														</div>
													</li>
												</ul>
												<a><i class="la la-eye"></i>Views 50</a>
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
													<img src="{{asset('storage/uploads')}}/{{$profile->user_image}}" alt="" width="57" height="57">
															<h3>{{ $profile->first_name }}</h3>
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
													<img src="{{asset('storage/uploads')}}/{{$post->user->user_image}}" alt="" width="50" height="50">
													<div class="usy-name">
														<span> {{ $post->user->first_name }}</span>
														{{-- <h3>{{$post->project_title}}</h3> --}}
														@if($post->image)
                                            <img src="{{asset('storage/uploads')}}/{{$post->user_image}}" width="200px" height="200px" alt="" />
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
											
                                            <img src="{{asset('storage/uploads')}}/{{$post->project_file}}" width="300px" height="200px" alt="" />
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
							<div class="col-lg-3 pd-right-none no-pd">
								<div class="right-sidebar">
                                    <div class="widget widget-about">
                                        <img src="images/umttt.png" alt="" height="150" width="130" style="margin-top: 9%">
                                        <div class="sign_link">
											<a href="#" title="">Learn More</a>
										</div> 
									</div><!--widget-about end-->
									<div class="widget widget-jobs">
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
									</div><!--widget-jobs end-->
									<div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Most Viewed This Week</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="jobs-list">
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Product Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior UI / UX Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Junior Seo Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
										</div><!--jobs-list end-->
									</div><!--widget-jobs end-->
									<div class="widget suggestions full-width">
										<div class="sd-title">
											<h3>Most Viewed People</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>John Doe</h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Poonam</h4>
													<span>Wordpress Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Bill Gates</h4>
													<span>C &amp; C++ Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="http://via.placeholder.com/35x35" alt="">
												<div class="sgt-text">
													<h4>John Doe</h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="view-more">
												<a href="#" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div>
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
					<form action="{{route('project_post')}}" method="POST" enctype="multipart/form-data">
                        @csrf
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="project_title" placeholder="Project Title">
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
								<input type="text" name="project_name" placeholder="Project Name">
							</div>
							<div class="col-lg-12">
								<input type="file" name="project_file" placeholder="file Upload">
							</div>
							<div class="col-lg-12">
								<textarea name="project_description" placeholder="Project Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		<div class="post-popup job_post">
			<div class="post-project">
				<h3>Create a Post</h3>
				<div class="post-project-fields">
					<form method="post" action="{{route('post')}}">
						@csrf
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
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
								<input type="text" name="subject" placeholder="Subject">
							</div>
							<div class="col-lg-12">
								<input type="file" name="image" placeholder="Image">
							</div>
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		<!-- Chat box with user messages start div -->
		<div class="chatbox-list">
				<!-- Chat box with user messages -->

<!-- Chat box with user messages -->
<div class="chatbox">
    


				<div class="chatbox">
					<div class="chat-mg bx">
						<a href="#" title=""><img src="images/chat.png" alt=""></a>
						<span>2</span>
					</div>
					<div class="conversation-box">
						<div class="con-title">
							<h3>Messages</h3>
							<a href="#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
						</div>
						{{-- <div class="chat-list">
							<div class="conv-list" onclick="openMessageBox('Abrar')">
								<div class="usrr-pic">
									<img src="http://via.placeholder.com/50x50" alt="">
									<span class="active-status activee"></span>
								</div>
								<div class="usy-info">
									<h3>Abrar</h3>
									<span>Lorem ipsum dolor <img src="images/smley.png" alt=""></span>
								</div>
								<div class="ct-time">
									<span>1:55 PM</span>
								</div>
								<span class="msg-numbers">2</span>
							</div>
							<div class="conv-list" onclick="openMessageBox('Zeeshan')">
								<div class="usrr-pic">
									<img src="http://via.placeholder.com/50x50" alt="">
								</div>
								<div class="usy-info">
									<h3>Zeeshan</h3>
									<span>Lorem ipsum dolor <img src="images/smley.png" alt=""></span>
								</div>
								<div class="ct-time">
									<span>11:39 PM</span>
								</div>
							</div>
							<div class="conv-list" onclick="openMessageBox('John Doe')">
								<div class="usrr-pic">
									<img src="http://via.placeholder.com/50x50" alt="">
								</div>
								<div class="usy-info">
									<h3>John Doe</h3>
									<span>Lorem ipsum dolor <img src="images/smley.png" alt=""></span>
								</div>
								<div class="ct-time">
									<span>0.28 AM</span>
								</div>
							</div>
						</div><!--chat-list end--> --}}


						<div class="chat-list">
							@foreach($chat as $profile)
							<div class="conv-list" onclick="openMessageBox('{{ $profile->id }}')">
								<div class="usrr-pic">
									<img src="{{ $profile->profile_picture }}" alt="">
									<span class="active-status activee"></span>
								</div>
								<div class="usy-info">
									<h3>{{ $profile->name }}</h3>
									<span>{{ $profile->last_message }}</span>
								</div>
								<div class="ct-time">
									<span>{{ $profile->last_message_time }}</span>
								</div>
								{{-- <span class="msg-numbers">{{ $profile->unread_messages }}</span> --}}
							</div>
							@endforeach
						</div><!-- chat-list end -->
						
						


					</div><!--conversation-box end-->
				</div>

				<!-- Message box (Initially hidden) -->
				<div class="message-box" style="display: none;">
					<div class="chatbox" >
						<div class="chat-mg">
							<a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a>
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
								
								<form action="{{ route('send_message', $user->id) }}" method="POST">
									@csrf
									<textarea placeholder="Type a message here" name="message"></textarea>
									<button type="submit"><i class="fa fa-send"></i></button>
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

				<script>
					function openMessageBox(username) {
						// Update the username in the message box
						document.getElementById("messageBoxUsername").innerText = username;
						
						// Show the message box
						document.querySelector(".message-box").style.display = "block";
					}
				</script>

<script>
    function openMessageBox(userId) {
        // Fetch the conversation messages from the database using the user ID
        fetch(`/getConversation/${userId}`)
            .then(response => response.json())
            .then(data => {
                // Update the message box with the conversation messages
                const messageHistory = document.querySelector(".chat-hist");
                messageHistory.innerHTML = "";

                data.forEach(message => {
                    const messageElement = document.createElement("div");
                    messageElement.classList.add("message");
                    messageElement.innerText = message.message;
                    messageHistory.appendChild(messageElement);
                });

                // Show the message box
                document.querySelector(".message-box").classList.remove("hidden");
            });
    }

    function sendMessage(event) {
        event.preventDefault();

        // Get the user's message
        const messageInput = document.getElementById("messageInput");
        const message = messageInput.value;

        // Clear the message input field
        messageInput.value = "";

        // Create a new message element
        const messageElement = document.createElement("div");
        messageElement.classList.add("message");
        messageElement.innerText = message;

        // Get the message history container
        const messageHistory = document.querySelector(".chat-hist");

        // Append the new message to the message history
        messageHistory.appendChild(messageElement);

        // Scroll to the bottom of the message history
        messageHistory.scrollTop = messageHistory.scrollHeight;

        // Send the message to the server to save in the database
        const recipientId = document.getElementById("recipientId").value;
        fetch(`/sendMessage/${recipientId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response if needed
        })
        .catch(error => {
            // Handle any errors
        });
    }
</script>











		</div><!--chat box with user message div end-->
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


		// comment ajax
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
		});
		</script>
   
@endsection




