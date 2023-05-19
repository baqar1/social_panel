
@extends('admin.layout')
@section('zee')
    <div class="container py-4">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            {{-- @if ($user) --}}
            <div class="usr-pic" style="margin-left: 8%;margin-top: 6%">
              <img src="{{asset('storage/uploads')}}/{{ auth()->user()->user_image}}" alt="" width="170" height="120">
              
            </div>
    {{-- <div style="margin-left: 25%;margin-top: 9%">
        <img src="{{asset('storage/uploads')}}/{{$user->user_image}}" alt="" width="50" height="50">
    </div> --}}
    <div class="card-body text-center">
        <h1 class="card-title mb-0">{{auth()->user()->first_name}}</h1><br>
    </div>
{{-- @else --}}
    <p>User not found.</p>
{{-- @endif --}}
            {{-- @foreach ($user as $user )
           <div style="margin-left: 25%;margin-top: 9%">
              <img src="{{asset('storage/uploads')}}/{{$user->user_image}}" alt="" width="50" height="50">
            
            </div>
            <div class="card-body text-center">
              <h1 class="card-title mb-0">{{$user->first_name}}</h1><br>
            </div>
            @endforeach --}}
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="d-flex justify-content-between">
                  <span>Followers</span>
                  <span>200</span>
                </div>
              </li>
              <li class="list-group-item">
                <div class="d-flex justify-content-between">
                  <span>Following</span>
                  <span>100</span>
                </div>
              </li>
            </ul>
            <div class="card-footer">
                <button class="btn btn-primary btn-block">Follow</button>
              </div>
            <div class="card-footer">
              <button class="btn btn-primary btn-block">Add Friend</button>
            </div>
            <div class="card-footer" style="text-align: center">
              <h1>Info</h1>
              <p>{{auth()->user()->first_name}}</p>
              <p>{{auth()->user()->last_name}}</p>
              <p>{{auth()->user()->department_id}}</p>
              <p>{{auth()->user()->semester}}</p>
              <p>{{auth()->user()->gender}}</p>
             
              
            </div>
            <div class="card-footer">
              <h5 class="card-title">Friends</h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <img src="https://via.placeholder.com/50" alt="Profile Picture" class="rounded-circle img-thumbnail me-2" />
                  <a href="#">Friend 1</a>
                </li>
                <li class="list-group-item">
                  <img src="https://via.placeholder.com/50" alt="Profile Picture" class="rounded-circle img-thumbnail me-2" />
                  <a href="#">Friend 2</a>
                </li>
                <li class="list-group-item">
                  <img src="https://via.placeholder.com/50" alt="Profile Picture" class="rounded-circle img-thumbnail me-2" />
                  <a href="#">Friend 3</a>
                </li>
              </ul>
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
                  {{-- <div class="card mb-3">
                    <img src="https://via.placeholder.com/500x300" alt="Post Image" class="card-img-top">
                    <div class="card-body">
                      <h5 class="card-title">Post Title</h5>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at leo lorem. </p>
                    </div>
                  </div> --}}
                </div>
              </div>  
              {{-- <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="card mb-3">
                    <img src="https://via.placeholder.com/500x300" alt="Post Image" class="card-img-top">
                    <div class="card-body">
                      <h5 class="card-title">Post Title</h5>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at leo lorem. </p>
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
@endsection
     
