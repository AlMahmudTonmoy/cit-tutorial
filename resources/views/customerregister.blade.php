@extends('layouts.frontend_master')

@section('content')
  <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6" style="background-image: url({{ asset('frontend_assets/images/bg/5.jpg') }})">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">My Account</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.html">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">My Account</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		<!-- Start My Account Area -->
		<section class="my_account_area pt--80 pb--55 bg--white">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Register</h3>
              @if (session('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}
                  </div>
              @endif
							<form action="{{ route('customerregisterinsert') }}" method="post">
                @csrf
								<div class="account__form">
									<div class="input__box">
										<label>Name <span>*</span></label>
										<input type="text" name="name">
									</div>
									<div class="input__box">
										<label>Email address <span>*</span></label>
										<input type="email" name="email">
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="password">
									</div>
									<div class="form__btn">
										<button>Register</button>
									</div>
                  <br>
                  <a href="{{ url('login/google') }}" class="btn btn-danger"><i class="fa fa-google">Register with Google</i></a>
                  <a href="{{ url('login/github') }}" class="btn btn-secondary"><i class="fa fa-github">Register with GitHub</i></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End My Account Area -->
@endsection
