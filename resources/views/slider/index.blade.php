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


                  <form method="post" action="{{ route('sliderinsert') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Slider Title</label>
                      <input type="text" class="form-control" placeholder="Enter Slider Title" name="slider_title">
                      @error('slider_title')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Slider Photo</label>
                      <input type="file" class="form-control" name="slider_photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Slider</button>
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
