<?php $__env->startSection('site-title', 'Tracking Pembelian'); ?>
<?php $__env->startSection('page-title', 'Tracking Pembelian Materi Video'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card border-left-primary mb-4">
    <div class="card-body">

        <h5 class="mb-4 font-weight-bold text-primary">
            Daftar Pembelian Materi Video
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>User ID</th>
                        <th>Nama</th>
                        <th>Materi</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($trx->user_id); ?></td>
                            <td><?php echo e($trx->user->name ?? '-'); ?></td>
                            <td><?php echo e(optional($trx->materi)->judul_materi ?? '-'); ?></td>

                            
                            <td>
                                <?php if($trx->is_free): ?>
                                    <span class="badge badge-success">Gratis (kuota)</span>
                                <?php else: ?>
                                    <span class="badge badge-primary">Berbayar</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($trx->status === 'sukses'): ?>
                                    <span class="badge badge-success">Sukses</span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?php echo e($trx->status); ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($trx->is_free): ?>
                                    Rp0
                                <?php else: ?>
                                    Rp<?php echo e(number_format($trx->jumlah, 0, ',', '.')); ?>

                                <?php endif; ?>
                            </td>

                            <td><?php echo e($trx->created_at->format('d-m-Y H:i')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/fasilitas.blade.php ENDPATH**/ ?>