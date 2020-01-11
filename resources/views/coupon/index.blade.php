@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card col-md-12">
                <div class="card-header">All Coupon List</div>
                <div class="card-body">
                  @if (session('delete_status'))
                      <div class="alert alert-danger">
                          {{ session('delete_status') }}
                      </div>
                  @endif
                  @if (session('edit_status'))
                      <div class="alert alert-info">
                          {{ session('edit_status') }}
                      </div>
                  @endif
                  <h1>Products</h1>
                  <table class="table table-bordered" id="product_list_table">
                    <thead>
                      <tr>
                        <th>Sl No</th>
                        <th>Coupon Code</th>
                        <th>Discount Amount</th>
                        <th>Coupon Validity</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($coupons as $coupon)
                      <tr>
                        <td>{{ ($coupons->currentpage()-1) * $coupons->perpage() + $loop->iteration }}</td>
                        <td>{{ $coupon->coupon_code }}</td>
                        <td>{{ $coupon->discount_amount }}</td>
                        <td>{{ $coupon->coupon_validity }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $coupons->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Product</div>
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif

                  @if ($errors->all())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  <!-- @error ('coupon_code')
                    <div class="alert alert-danger">
                      <li>{{ $message }}</li>
                    </div>
                  @enderror -->
                  <form method="post" action="{{ route('couponinsert') }}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Coupon Code</label>
                      <input type="text" class="form-control" name="coupon_code" value="{{ Str::upper(Str::random(8)) }}">
                      @error('coupon_code')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Discount Amount</label>
                      <input type="text" class="form-control" name="discount_amount">
                      @error('discount_amount')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Coupon Validity</label>
                      <div class="row">
                        <div class="col-6">
                          <input type="date" class="form-control" name="coupon_validity_date">
                        </div>
                        <div class="col-6">
                          <input type="time" class="form-control" name="coupon_validity_time">
                        </div>
                      </div>
                      @error('coupon_validity_date')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Coupon</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
