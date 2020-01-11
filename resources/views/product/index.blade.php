@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card col-md-12">
                <div class="card-header">Product List</div>
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
                  <table class="table table-bordered table-responsive" id="product_list_table">
                    <thead>
                      <tr>
                        <th>Sl No</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Product Photo</th>
                        <th>Alert Quantity</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($products as $product)
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->relationtocategorytable->category_name }}</td>
                        {{-- <td>{{ App\Category::find($product->category_id)->category_name }}</td> --}}
                        <td>{{ $product->product_price }}</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>
                          <img width="50" height="50" src="{{ asset('uploads/product_photos')}}/{{ $product->product_photo }}" alt="No Image Found">
                        </td>
                        <td>{{ $product->alert_quantity }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                          @if($product->deleted_at)
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <a type="button" class="btn btn-info" href="{{ url('product/restore') }}/{{ $product->id }}">Restore</a>
                              <button type="button" class="btn btn-danger delete_btn" value="{{ url('product/force/delete') }}/{{ $product->id }}">Delete</button>
                            </div>
                          @else
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <a type="button" class="btn btn-warning" href="{{ url('product/edit') }}/{{ $product->id }}">Edit</a>
                              <a type="button" class="btn btn-danger" href="{{ url('product/delete') }}/{{ $product->id }}">Remove</a>
                            </div>
                          @endif
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="60" class="text-center text-danger
                        ">No Data Available</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Add Product</div>
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif

                  <!-- @if ($errors->all())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif -->


                  <form method="post" action="{{ url('product/insert') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <select class="form-control" name="category_id">
                        <option value="">-Select One-</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{ old('product_name') }}">
                      @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Short Description</label>
                      <textarea class="form-control" name="product_short_description" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Long Description</label>
                      <textarea class="form-control" name="product_long_description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Price</label>
                      <input type="text" class="form-control"placeholder="Enter Product Price" name="product_price" value="{{ old('product_price') }}">
                      @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Quantity</label>
                      <input type="text" class="form-control"placeholder="Enter Product Quantity" name="product_quantity" value="{{ old('product_quantity') }}">
                      @error('product_quantity')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alert Quentity</label>
                      <input type="text" class="form-control"placeholder="Enter Alert Quantity" name="alert_quantity" value="{{ old('alert_quantity') }}">
                      @error('alert_quantity')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Photo</label>
                      <input type="file" class="form-control" name="product_photo">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Gallery</label>
                      <input type="file" class="form-control" name="product_gallery[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('datatable')
  <script type="text/javascript">
      $(document).ready(function() {
          $('#product_list_table').DataTable();
          $('.delete_btn').click(function(){
            var gotolink = $(this).val();
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                window.location.href = gotolink;
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success',
                )
              }
            })
          });
      } );
  </script>

@endsection
