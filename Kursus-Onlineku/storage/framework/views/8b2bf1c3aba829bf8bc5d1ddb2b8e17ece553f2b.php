<?php $__env->startSection('site-title', __('admin.materi_pdf')); ?>
<?php $__env->startSection('page-title', __('admin.materi_pdf_manage')); ?>
<?php $__env->startSection('isMateriPdf', 'active'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card border-left-primary mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><?php echo e(__('admin.materi_pdf_list')); ?></span>
        <a href="<?php echo e(route('materi-pdf.create')); ?>" class="btn btn-primary btn-sm">
            <?php echo e(__('admin.materi_pdf_add')); ?>

        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered datatables">
            <thead>
                <tr>
                    <th style="width: 60px;"><?php echo e(__('admin.no')); ?></th>
                    <th><?php echo e(__('admin.pdf_title')); ?></th>
                    <th><?php echo e(__('admin.file')); ?></th>
                    <th style="width: 140px;"><?php echo e(__('admin.actions')); ?></th>
                </tr>
            </thead>

            <tbody>
            <?php $__currentLoopData = $materiPdfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $materi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($materi->judul_materi); ?></td>
                    <td><?php echo e($materi->filename); ?></td>
                    <td>
                        <a href="<?php echo e(route('materi-pdf.show', $materi->id_materi)); ?>"
                           class="btn btn-info btn-sm" title="<?php echo e(__('admin.detail')); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>

                        <a href="<?php echo e(route('materi-pdf.edit', $materi->id_materi)); ?>"
                           class="btn btn-primary btn-sm" title="<?php echo e(__('admin.edit')); ?>">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="<?php echo e(route('materi-pdf.destroy', $materi->id_materi)); ?>"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('<?php echo e(__('admin.confirm_delete_pdf')); ?>')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" title="<?php echo e(__('admin.delete')); ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/materi-pdf-index.blade.php ENDPATH**/ ?>