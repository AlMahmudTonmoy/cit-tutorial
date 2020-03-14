<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card col-md-12">
                <div class="card-header">Product List</div>
                <div class="card-body">
                  <?php if(session('delete_status')): ?>
                      <div class="alert alert-danger">
                          <?php echo e(session('delete_status')); ?>

                      </div>
                  <?php endif; ?>
                  <?php if(session('edit_status')): ?>
                      <div class="alert alert-info">
                          <?php echo e(session('edit_status')); ?>

                      </div>
                  <?php endif; ?>
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
                      <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <th><?php echo e($loop->index+1); ?></th>
                        <td><?php echo e($category->category_name); ?></td>
                        <td><?php echo e(App\User::findOrFail($category->added_by)->name); ?></th>
                        <td><?php echo e($category->created_at); ?></td>
                        <td>
                          -
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <tr>
                        <td colspan="60" class="text-center text-danger
                        ">No Data Available</td>
                      </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                  <?php if(session('status')): ?>
                      <div class="alert alert-success">
                          <?php echo e(session('status')); ?>

                      </div>
                  <?php endif; ?>

                  <form method="post" action="<?php echo e(route('category.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="<?php echo e(old('product_name')); ?>">
                      <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn btn-success">Add Category</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('datatable'); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/category/index.blade.php ENDPATH**/ ?>