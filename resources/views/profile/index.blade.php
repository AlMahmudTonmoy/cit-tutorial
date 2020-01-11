@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
                  <form method="post" action="{{ route('passwordchange') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Old Password</label>
                      <input type="password" class="form-control" placeholder="Enter Product Name" name="old_password">
                      @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">New Password</label>
                      <div class="input-group">
                        <input type="password" id="newpassword" class="form-control" placeholder="Enter Product Name" name="new_password">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="showbutton" onclick="showPasswordFunction()">Show <span class="fa fa-eye"></span> </button>
                          <script type="text/javascript">
                          function showPasswordFunction() {
                            var x = document.getElementById("newpassword");
                            var y = document.getElementById("showbutton");
                            if (x.type === "password") {
                              x.type = "text";
                              y.innerHTML = "Hide <span class='fa fa-eye-slash'></span>"
                            } else {
                              x.type = "password";
                              y.innerHTML = "Show <span class='fa fa-eye'></span>"
                            }
                          }
                          </script>
                        </div>
                      </div>
                      @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Confirm Password</label>
                      <input type="password" class="form-control" placeholder="Enter Product Name" name="confirm_password">
                      @error('confirm_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Change Password</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
