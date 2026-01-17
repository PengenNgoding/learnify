<?php $__env->startSection('site-title', 'Detail Materi PDF'); ?>
<?php $__env->startSection('page-title', 'Detail Materi PDF'); ?>
<?php $__env->startSection('isMateriPdf', 'active'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="row">
    <div class="col-12 mb-3 d-flex align-items-center">
        <a href="<?php echo e(route('materi-pdf.peserta.index')); ?>" class="mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4 class="mb-0"><?php echo e($materi->judul_materi); ?></h4>
    </div>

    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body" style="height: 80vh;">
                <iframe
                    src="<?php echo e(route('materi-pdf.file', $materi->id_materi)); ?>"
                    style="width: 100%; height: 100%; border: none;"
                ></iframe>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/materi-pdf-peserta-view.blade.php ENDPATH**/ ?>