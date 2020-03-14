<?php $__env->startSection('content'); ?>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-9">
              <div class="card col-md-12">
                  <div class="card-header">Product List</div>
                    <div class="">
                      <div class="card-body">
                        <h1>Welcome Customer</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Sl No</th>
                                <th>Order Total</th>
                                <th>Coupon Name</th>
                                <th>Purchased At</th>
                                <th>Download as PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <th><?php echo e($loop->index+1); ?></th>
                                <td><?php echo e($sale->order_total); ?></td>
                                <td><?php echo e($sale->coupon_code ?? "No Coupon Used"); ?></td>
                                <td>
                                    <?php if($sale->created_at->diffForHumans() == '1 week ago'): ?>
                                    <?php echo e($sale->created_at->format('d-M-Y H:i:s A')); ?>

                                    <?php else: ?>
                                    <?php echo e($sale->created_at->diffForHumans()); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                <a href="<?php echo e(url('download/pdf')); ?>/<?php echo e($sale->id); ?>" name="button" target="_blank" class="btn btn-primary btn-sm">Download</a>
                                </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            </table>
                      </div>
                    </div>
              </div>
          </div>
      </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>