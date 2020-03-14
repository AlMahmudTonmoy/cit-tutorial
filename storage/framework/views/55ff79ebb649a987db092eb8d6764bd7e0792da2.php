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


                  <form method="post" action="<?php echo e(route('sliderinsert')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Slider Title</label>
                      <input type="text" class="form-control" placeholder="Enter Slider Title" name="slider_title">
                      <?php $__errorArgs = ['slider_title'];
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/slider/index.blade.php ENDPATH**/ ?>