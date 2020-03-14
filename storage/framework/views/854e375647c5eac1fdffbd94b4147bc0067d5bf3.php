<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card col-md-12">
                <div class="card-header">All Coupon List</div>
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
                        <th>Sl No</th>
                        <th>Coupon Code</th>
                        <th>Discount Amount</th>
                        <th>Coupon Validity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e(($coupons->currentpage()-1) * $coupons->perpage() + $loop->iteration); ?></td>
                        <td><?php echo e($coupon->coupon_code); ?></td>
                        <td><?php echo e($coupon->discount_amount); ?></td>
                        <td><?php echo e($coupon->coupon_validity); ?></td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                  <?php echo e($coupons->links()); ?>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Product</div>
                <div class="card-body">
                  <?php if(session('status')): ?>
                      <div class="alert alert-success">
                          <?php echo e(session('status')); ?>

                      </div>
                  <?php endif; ?>

                  <?php if($errors->all()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php endif; ?>

                  <!-- <?php $__errorArgs = ['coupon_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger">
                      <li><?php echo e($message); ?></li>
                    </div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> -->
                  <form method="post" action="<?php echo e(route('couponinsert')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Coupon Code</label>
                      <input type="text" class="form-control" name="coupon_code" value="<?php echo e(Str::upper(Str::random(8))); ?>">
                      <?php $__errorArgs = ['coupon_code'];
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
                      <label for="exampleInputEmail1">Discount Amount</label>
                      <input type="text" class="form-control" name="discount_amount">
                      <?php $__errorArgs = ['discount_amount'];
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
                      <label for="exampleInputEmail1">Coupon Validity</label>
                      <div class="row">
                        <div class="col-6">
                          <input type="date" class="form-control" name="coupon_validity_date">
                        </div>
                        <div class="col-6">
                          <input type="time" class="form-control" name="coupon_validity_time">
                        </div>
                      </div>
                      <?php $__errorArgs = ['coupon_validity_date'];
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
                    <button type="submit" class="btn btn-primary">Add Coupon</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/coupon/index.blade.php ENDPATH**/ ?>