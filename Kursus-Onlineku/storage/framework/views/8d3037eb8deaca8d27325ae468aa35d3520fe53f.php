<?php $__env->startSection('site-title', __('ui.dashboard')); ?>
<?php $__env->startSection('page-title', __('ui.dashboard')); ?>
<?php $__env->startSection('isDashboard', 'active'); ?>
<?php $__env->startSection('isMateriPdfPeserta', 'active'); ?>

<?php $__env->startSection('custom-style-library'); ?>
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<?php
    // Biar aman: kalau controller gak ngirim $materis, gak bakal error
    $materis = $materis ?? collect();
?>

<div class="row">
    <div class="col-12">
        <div class="card-columns">

            <?php $__empty_1 = true; $__currentLoopData = $materis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(url('view-materi/' . $materi->id_materi)); ?>" style="text-decoration:none;">
                    <div class="card mb-5">
                        <div class="col" style="padding: 0; height: 140px; overflow: hidden;">
                            <video class="player" playsinline muted style="width: 100%; height: 140px; object-fit: cover;">
                                <source src="<?php echo e(url('/getVidMateri/' . $materi->id_materi)); ?>" type="video/mp4">
                            </video>
                        </div>

                        <div class="card-body">
                            <p class="card-text text-primary font-weight-bold">
                                <?php echo e($materi->judul_materi); ?>

                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="alert alert-info">
                    <?php echo e(__('ui.no_materials')); ?>

                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('necessary-library'); ?>
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Init semua video yang classnya "player"
    Plyr.setup('.player', {
        controls: [], // biar gak ada tombol kontrol
        clickToPlay: false
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/home-peserta.blade.php ENDPATH**/ ?>