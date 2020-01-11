@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Edit Product - {{ $product_info->product_name }}</div>
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
                  <form method="post" action="{{ url('product/edit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="hidden" class="form-control" name="product_id" value="{{ $product_info->id }}">
                      <input type="text" class="form-control"placeholder="Enter Product Name" name="product_name" value="{{ $product_info->product_name }}">
                      @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <select class="form-control" name="category_id">
                        <option value="">-Select One-</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($product_info->category_id == $category->id) ? "selected":"" }}
                          {{-- below commented code is for giving select attribute --}}
                          {{-- @if($product_info->category_id == $category->id)
                            selected
                          @endif --}}
                          >{{ $category->category_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Price</label>
                      <input type="text" class="form-control"placeholder="Enter Product Price" name="product_price" value="{{ $product_info->product_price }}">
                      @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Quantity</label>
                      <input type="text" class="form-control"placeholder="Enter Product Quantity" name="product_quantity" value="{{ $product_info->product_quantity }}">
                      @error('product_quantity')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alert Quentity</label>
                      <input type="text" class="form-control"placeholder="Enter Alert Quantity" name="alert_quantity" value="{{ $product_info->alert_quantity }}">
                      @error('alert_quantity')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Change Image</label>
                      <input type="file" class="form-control" name="new_photo" onchange="readURL(this);">
                      <img class="hidden" id="tenant_photo_viewer" src="#" alt=""/>
                      <script>
                          function readURL(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                $('#tenant_photo_viewer').attr('src', e.target.result).width(50).height(50);
                              };
                              $('#tenant_photo_viewer').removeClass('hidden');
                              reader.readAsDataURL(input.files[0]);
                            }
                          }
                      </script>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Current Image</label>
                      <img width="50" height="50" src="{{ asset('uploads/product_photos') }}/{{ $product_info->product_photo }}" alt="Product Not Found">
                    </div>
                    <button type="submit" class="btn btn-info">Edit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
