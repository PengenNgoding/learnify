<?php $__env->startSection('site-title', __('ui.materi_pdf')); ?>
<?php $__env->startSection('page-title', __('ui.materi_pdf')); ?>
<?php $__env->startSection('isMateriPdfPeserta', 'active'); ?>

<?php $__env->startSection('main-content'); ?>

<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $materiPdfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <a href="<?php echo e(route('materi-pdf.peserta.show', $materi->id_materi)); ?>" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden;">
                    
                    <div class="d-flex align-items-center justify-content-center"
                         style="height: 200px; background:#f5f7fb;">
                        <img src="<?php echo e(asset('assets/img/pdf.png')); ?>" alt="<?php echo e(__('ui.pdf')); ?>"
                             style="width: 80px; opacity: .9;">
                    </div>

                    
                    <div class="card-body">
                        <p class="card-text text-primary font-weight-bold mb-0">
                            <?php echo e($materi->judul_materi); ?>

                        </p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <p><?php echo e(__('ui.no_pdf_materials')); ?></p>
        </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/materi-pdf-peserta-index.blade.php ENDPATH**/ ?>