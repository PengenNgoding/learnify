<?php $__env->startSection('site-title', __('app.announcements')); ?>
<?php $__env->startSection('page-title', __('app.announcement_detail')); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card border-left-primary">
    <div class="card-body">
        <h4 class="mb-2"><?php echo e($announcement->judul); ?></h4>

        <div class="text-muted mb-3">
            <?php echo e($announcement->created_at->format('d M Y H:i')); ?>

        </div>

        <div style="white-space: pre-wrap;"><?php echo e($announcement->isi); ?></div>

        <a href="<?php echo e(route('announcements.peserta.index')); ?>" class="btn btn-secondary mt-3">
            <?php echo e(__('app.back')); ?>

        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/announcements-peserta-show.blade.php ENDPATH**/ ?>