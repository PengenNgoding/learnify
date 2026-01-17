<?php $__env->startSection('site-title', __('admin.announcements')); ?>
<?php $__env->startSection('page-title', __('admin.announcements_create')); ?>

<?php $__env->startSection('main-content'); ?>
<div class="row">
    <div class="col-lg-8">
        <div class="card border-left-primary mb-4">
            <div class="card-body">

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($err); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('announcements.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label><?php echo e(__('admin.title')); ?></label>
                        <input type="text" name="judul" class="form-control"
                               value="<?php echo e(old('judul')); ?>" required>
                        <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label><?php echo e(__('admin.announcement_content')); ?></label>
                        <textarea name="isi" rows="5" class="form-control" required><?php echo e(old('isi')); ?></textarea>
                        <?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <?php
                        // datetime-local butuh format: YYYY-MM-DDTHH:MM
                        $oldMulai = old('tanggal_mulai');
                        $oldSelesai = old('tanggal_selesai');

                        $mulaiVal = $oldMulai ? \Illuminate\Support\Str::of($oldMulai)->replace(' ', 'T')->substr(0, 16) : '';
                        $selesaiVal = $oldSelesai ? \Illuminate\Support\Str::of($oldSelesai)->replace(' ', 'T')->substr(0, 16) : '';
                    ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><?php echo e(__('admin.start_date_optional')); ?></label>
                            <input type="datetime-local" name="tanggal_mulai"
                                   class="form-control"
                                   value="<?php echo e($mulaiVal); ?>">
                            <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label><?php echo e(__('admin.end_date_optional')); ?></label>
                            <input type="datetime-local" name="tanggal_selesai"
                                   class="form-control"
                                   value="<?php echo e($selesaiVal); ?>">
                            <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group form-check">
                        <input type="hidden" name="is_active" value="0">

                        <input type="checkbox" name="is_active" id="is_active"
                               class="form-check-input" value="1"
                               <?php echo e(old('is_active', 1) ? 'checked' : ''); ?>>

                        <label for="is_active" class="form-check-label"><?php echo e(__('admin.active')); ?></label>

                        <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <br><small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="btn btn-primary"><?php echo e(__('admin.save')); ?></button>
                    <a href="<?php echo e(route('announcements.index')); ?>" class="btn btn-secondary"><?php echo e(__('admin.cancel')); ?></a>
                </form>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/announcements-create.blade.php ENDPATH**/ ?>