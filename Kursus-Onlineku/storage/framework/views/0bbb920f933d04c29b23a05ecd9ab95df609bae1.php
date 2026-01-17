<?php $__env->startSection('site-title', __('ui.history')); ?>
<?php $__env->startSection('page-title', __('ui.history')); ?>
<?php $__env->startSection('isHistory', 'active'); ?>

<?php $__env->startSection('custom-style-library'); ?>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<?php
    $materis = $materis ?? collect();
    $materiPdfs = $materiPdfs ?? collect();
?>

<div class="row">
    
    <?php $__currentLoopData = $materis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <a href="<?php echo e(route('view-materi', $materi->id_materi)); ?>" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden;">
                    <div class="col" style="padding:0; height:180px; overflow:hidden;">
                        <video class="player" style="width:100%; object-fit:cover;">
                            <source src="<?php echo e(route('materi.video', $materi->id_materi)); ?>">
                        </video>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-primary font-weight-bold mb-0">
                            <?php echo e($materi->judul_materi); ?>

                        </p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $materiPdfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <a href="<?php echo e(route('materi-pdf.peserta.show', $pdf->id_materi)); ?>" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden;">
                    <div class="d-flex align-items-center justify-content-center"
                         style="height: 180px; background:#f5f7fb;">
                        <img src="<?php echo e(asset('assets/img/pdf.png')); ?>" alt="<?php echo e(__('ui.pdf')); ?>"
                             style="width: 70px; opacity:.9;">
                    </div>
                    <div class="card-body">
                        <p class="card-text text-primary font-weight-bold mb-0">
                            <?php echo e($pdf->judul_materi); ?>

                        </p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if($materis->isEmpty() && $materiPdfs->isEmpty()): ?>
        <div class="col-12">
            <p><?php echo e(__('ui.no_history')); ?></p>
        </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('necessary-library'); ?>
    <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
    <script>
        $(function () {
            Plyr.setup('.player', {
                enabled: false,
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/history.blade.php ENDPATH**/ ?>