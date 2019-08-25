@extends('WorkReport.layouts.layout')

@section("title",$title)

@section("content")
 <div class="row content_frm">
			<div class="col-lg-12">
                @if ($errors->any())
		      <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		              <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		      </div><br />
		    @endif
				<div class="panel panel-primary">
				  <div class="panel-heading">
					<h3 class="panel-title">New User Registration</h3>
				  </div>

				  <div class="panel-body">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<form class="form-horizontal" action="{{ url('WorkReport/userstore') }}" enctype="multipart/form-data" method="POST">
						      @csrf		
							  <div class="form-group">
								  <label for="inputEmail3" class="col-sm-3 control-label">User name</label>
								  <div class="col-sm-9">
								    <input type="text"  name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Users Name" required >
								  </div>
							  </div>


                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">First name</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="first_name" value="{{ old('first_name') }}" class="form-control" id="first_name" placeholder="Fist Name" required >
                                </div>
                              </div>

                               <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Last name</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="last_name" value="{{ old('last_name') }}" class="form-control" id="last_name" placeholder="Last Name" required >
                                </div>
                              </div>
                                      
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                  <input type="email"  class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Id" required >
                                </div>
                              </div>
                               <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                  <input type="password" class="form-control" id="password" name="password"  placeholder="password" value="{{ old('password') }}" required>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">User Role</label>
                                <div class="col-sm-9">
                                 <select name="role" class="form-control" required>
                                  <option value="">Select Role</option>
                                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>user</option>
                                 </select>
                                </div>
                                </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="Mobile Number" required >
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="address" class="form-control" id="address" placeholder="Address" value="{{ old('address') }}" required >
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9">
                                 <select name="active" class="form-control" required>
                                  <option value="">Select Status</option>
                                    <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>Inactive</option>
                                 </select>
                                </div>
                                </div>
                                
							  <div class="form-group">
								 <div class="col-sm-offset-3 col-sm-9">
								    <input  type="submit" class="btn btn-primary" name="submit" value="Submit">
								    <a class="btn btn-danger" href="{{ url('WorkReport/userlist') }}">Cancel</a>
								 </div>
							  </div>
							 </form>
						</div>
					</div>
				  </div>
				</div>
			</div>
		</div>
@endsection