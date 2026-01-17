<?php $__env->startSection('site-title', __('admin.announcements')); ?>
<?php $__env->startSection('page-title', __('admin.announcements_list')); ?>

<?php $__env->startSection('main-content'); ?>
<div class="row">
    <div class="col-12">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="card border-left-primary mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('admin.announcements_list')); ?></h6>

                <a href="<?php echo e(route('announcements.create')); ?>" class="btn btn-sm btn-primary">
                    + <?php echo e(__('admin.add_announcement')); ?>

                </a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%"><?php echo e(__('admin.no')); ?></th>
                            <th><?php echo e(__('admin.title')); ?></th>
                            <th><?php echo e(__('admin.active')); ?></th>
                            <th><?php echo e(__('admin.start_date')); ?></th>
                            <th><?php echo e(__('admin.end_date')); ?></th>
                            <th width="15%"><?php echo e(__('admin.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($a->judul); ?></td>
                                <td>
                                    <?php if($a->is_active): ?>
                                        <span class="badge badge-success"><?php echo e(__('admin.status_active')); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary"><?php echo e(__('admin.status_inactive')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(optional($a->tanggal_mulai)->format('d-m-Y H:i')); ?></td>
                                <td><?php echo e(optional($a->tanggal_selesai)->format('d-m-Y H:i')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('announcements.edit', $a->id)); ?>"
                                       class="btn btn-sm btn-warning"><?php echo e(__('admin.edit')); ?></a>

                                    <form action="<?php echo e(route('announcements.destroy', $a->id)); ?>"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('<?php echo e(__('admin.confirm_delete_announcement')); ?>')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger"><?php echo e(__('admin.delete')); ?></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center"><?php echo e(__('admin.no_announcements')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/announcements-index.blade.php ENDPATH**/ ?>