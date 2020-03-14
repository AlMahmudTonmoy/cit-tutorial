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
                      <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <td><?php echo e($loop->index+1); ?></td>
                        <td><?php echo e($product->product_name); ?></td>
                        <td><?php echo e($product->relationtocategorytable->category_name); ?></td>
                        
                        <td><?php echo e($product->product_price); ?></td>
                        <td><?php echo e($product->product_quantity); ?></td>
                        <td>
                          <img width="50" height="50" src="<?php echo e(asset('uploads/product_photos')); ?>/<?php echo e($product->product_photo); ?>" alt="No Image Found">
                        </td>
                        <td><?php echo e($product->alert_quantity); ?></td>
                        <td><?php echo e($product->created_at); ?></td>
                        <td>
                          <?php if($product->deleted_at): ?>
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <a type="button" class="btn btn-info" href="<?php echo e(url('product/restore')); ?>/<?php echo e($product->id); ?>">Restore</a>
                              <button type="button" class="btn btn-danger delete_btn" value="<?php echo e(url('product/force/delete')); ?>/<?php echo e($product->id); ?>">Delete</button>
                            </div>
                          <?php else: ?>
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <a type="button" class="btn btn-warning" href="<?php echo e(url('product/edit')); ?>/<?php echo e($product->id); ?>">Edit</a>
                              <a type="button" class="btn btn-danger" href="<?php echo e(url('product/delete')); ?>/<?php echo e($product->id); ?>">Remove</a>
                            </div>
                          <?php endif; ?>
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
                <div class="card-header">Add Product</div>
                <div class="card-body">
                  <?php if(session('status')): ?>
                      <div class="alert alert-success">
                          <?php echo e(session('status')); ?>

                      </div>
                  <?php endif; ?>

                  <!-- <?php if($errors->all()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php endif; ?> -->


                  <form method="post" action="<?php echo e(url('product/insert')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <select class="form-control" name="category_id">
                        <option value="">-Select One-</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="<?php echo e(old('product_name')); ?>">
                      <?php $__errorArgs = ['product_price'];
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
                      <input type="text" class="form-control"placeholder="Enter Product Price" name="product_price" value="<?php echo e(old('product_price')); ?>">
                      <?php $__errorArgs = ['product_price'];
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
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Quantity</label>
                      <input type="text" class="form-control"placeholder="Enter Product Quantity" name="product_quantity" value="<?php echo e(old('product_quantity')); ?>">
                      <?php $__errorArgs = ['product_quantity'];
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
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alert Quentity</label>
                      <input type="text" class="form-control"placeholder="Enter Alert Quantity" name="alert_quantity" value="<?php echo e(old('alert_quantity')); ?>">
                      <?php $__errorArgs = ['alert_quantity'];
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/product/index.blade.php ENDPATH**/ ?>