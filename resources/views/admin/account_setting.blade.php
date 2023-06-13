
@extends('admin.layout')
@section('umt')
<div class="container" style="padding: 2%;">
    <div class="card" div >
        <div class="card-header"div style="color: #fff;background-color: #e44d3a;width:100%;">
            <b>Account Setting</b>
        </div><br>
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

            <div class="card-body">

                <form method="POST" action="{{ route('account_update', $users->id) }}" enctype="multipart/form-data">

                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label class="required" for="name">Name</label><br>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                               name="name" id="title"size = "118" value="{{ old('title', $users->name) }}" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block"> </span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="last_name">Last Name</label><br>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                               name="last_name" id="last_name"size = "118" value="{{ old('last_name', $users->last_name) }}" required>
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                        <span class="help-block"> </span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="email">Email</label><br>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                               name="email" id="email"size = "118" value="{{ old('email', $users->email) }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block"> </span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="phone_number">phone_number</label><br>
                        <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text"
                               name="phone_number" id="phone_number"size = "118" value="{{ old('phone_number', $users->phone_number) }}" required>
                        @if($errors->has('phone_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone_number') }}
                            </div>
                        @endif
                        <span class="help-block"> </span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="image">Image</label><br>

                        <input class="form-control {{ $errors->has('user_image') ? 'is-invalid' : '' }}" type="file"
                               name="user_image" id="user_image" value="{{ old('user_image') }}">
                        @if($errors->has('user_image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('user_image') }}
                            </div>
                        @endif


                    </div>
                    <div class="form-group">
                        @if($users->user_image)
                            <img src="{{asset('uploads')}}/{{$users->user_image}}" width="200px" height="200px" alt="" />
                        @endif
                    </div><br><br><br><br><br><br><br><br><br><br><br><br><br>

                    <div class="form-group">
                        <label class="required" for="gender">Gender</label><br>
                        <select name="gender" class="form-control" id="gender" style="width: 100%" required>
                            <option value="">--- SELECT Gender ---</option>
                            <option value="male" {{($users->gender=='male')?'selected':''}}>Male</option>
                            <option value="female" {{($users->gender=='female')?'selected':''}}>Female</option>
                            <option value="others" {{($users->gender=='others')?'selected':''}}>Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="required" for="department_id">Department</label><br>
                        <select name="department_id" class="form-control" id="department_id" style="width: 100%" required>
                            <option value="">--- SELECT Department ---</option>
                            <option value="BSCS" {{($users->department_id=='BSCS')?'selected':''}}>BSCS</option>
                            <option value="BSSE" {{($users->department_id=='BSSE')?'selected':''}}>BSSE</option>
                            <option value="BSIT" {{($users->department_id=='BSIT')?'selected':''}}>BSIT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="required" for="batch">Batch</label><br>
                        <input class="form-control {{ $errors->has('batch') ? 'is-invalid' : '' }}" type="text"
                               name="batch" id="batch"size = "118" value="{{ old('batch', $users->batch) }}" required>
                        @if($errors->has('batch'))
                            <div class="invalid-feedback">
                                {{ $errors->first('batch') }}
                            </div>
                        @endif
                        <span class="help-block"> </span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="semester">Semester</label><br>
                        <select name="semester" class="form-control" id="semester" style="width: 100%" required>
                            <option value="#">--- SELECT Semester ---</option>
                            <option value="1" {{($users->semester=='1')?'selected':''}}>1</option>
                            <option value="1" {{($users->semester=='2')?'selected':''}}>2</option>
                            <option value="1" {{($users->semester=='3')?'selected':''}}>3</option>
                            <option value="1" {{($users->semester=='4')?'selected':''}}>4</option>
                            <option value="1" {{($users->semester=='5')?'selected':''}}>5</option>
                            <option value="1" {{($users->semester=='6')?'selected':''}}>6</option>
                            <option value="1" {{($users->semester=='7')?'selected':''}}>7</option>
                            <option value="1" {{($users->semester=='8')?'selected':''}}>8</option>
                        </select>
                        @if($errors->has('semester'))
                            <div class="invalid-feedback">
                                {{ $errors->first('semester') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary" style="background-color: #007bff" type="submit">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
