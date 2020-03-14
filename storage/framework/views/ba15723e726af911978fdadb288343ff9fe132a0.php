<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All User List</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <!-- <?php
                      print_r($users);
                    ?>
                    You are logged in! -->
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Account Opened At</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <th><?php echo e($loop->index+1); ?></th>
                          <th><?php echo e($user->name); ?></th>
                          <td><?php echo e($user->email); ?></td>
                          <td><?php echo e($user->password); ?></td>
                          <td>
                            <?php if($user->created_at->diffForHumans() == '1 week ago'): ?>
                              <?php echo e($user->created_at->format('d-M-Y H:i:s A')); ?>

                            <?php else: ?>
                              <?php echo e($user->created_at->diffForHumans()); ?>

                            <?php endif; ?>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php echo $chart->container(); ?>

            <?php echo $chart->script(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/home.blade.php ENDPATH**/ ?>