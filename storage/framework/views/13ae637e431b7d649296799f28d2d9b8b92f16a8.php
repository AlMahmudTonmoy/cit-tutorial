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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>First Name</th>
                          <th>Email</th>
                          <th>Website</th>
                          <th>Uploaded File</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <th><?php echo e($loop->index+1); ?></th>
                          <th><?php echo e($contact->first_name); ?></th>
                          <td><?php echo e($contact->email); ?></td>
                          <td><?php echo e($contact->website); ?></td>
                          <td>
                            <?php if($contact->upload_file == 'not inserted'): ?>
                              -
                            <?php else: ?>
                              <a href="<?php echo e(asset('storage\contacts_uploads')); ?>/<?php echo e($contact->upload_file); ?>" class="btn btn-primary" target="_blank">View Now</a>
                              <a href="<?php echo e(url('contact/upload/download')); ?>/<?php echo e($contact->upload_file); ?>" class="btn btn-primary">Download Now</a>
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
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/contact/index.blade.php ENDPATH**/ ?>