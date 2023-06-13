
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
											<li><a href="#" title="" class="followw">Follow</a></li>
											<li><a href="#" title="" class="envlp"><img src="images/envelop.png" alt=""></a></li>

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


@endsection
