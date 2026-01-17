<?php $__env->startSection('site-title', __('app.announcements')); ?>
<?php $__env->startSection('page-title', __('app.announcements')); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card border-left-primary">
    <div class="card-body">
        <?php if($announcements->count() == 0): ?>
            <div class="alert alert-info mb-0"><?php echo e(__('app.no_announcement')); ?></div>
        <?php else: ?>
            <div class="list-group">
                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $isUnread = !in_array($a->id, $readIds); ?>

                    <a href="<?php echo e(route('announcements.peserta.show', $a->id)); ?>"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo e($isUnread ? 'font-weight-bold' : ''); ?>">
                        <div>
                            <div><?php echo e($a->judul); ?></div>
                            <small class="text-muted"><?php echo e($a->created_at->format('d M Y H:i')); ?></small>
                        </div>

                        <?php if($isUnread): ?>
                            <span class="badge badge-danger"><?php echo e(__('app.new')); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/announcements-peserta-index.blade.php ENDPATH**/ ?>