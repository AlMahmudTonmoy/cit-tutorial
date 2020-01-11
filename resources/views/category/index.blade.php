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
                  <table class="table table-bordered" id="product_list_table">
                    <thead>
                      <tr>
                        <td>Sl No</td>
                        <td>Category Name</td>
                        <td>Added By</td>
                        <td>Created At</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($categories as $category)
                      <tr>
                        <th>{{ $loop->index+1 }}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ App\User::findOrFail($category->added_by)->name }}</th>
                        <td>{{ $category->created_at }}</td>
                        <td>
                          -
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
                <div class="card-header">Add Category</div>
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif

                  <form method="post" action="{{ route('category.store') }}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ old('product_name') }}">
                      @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Add Category</button>
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
