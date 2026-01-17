<?php $__env->startSection('site-title', __('admin.material')); ?>
<?php $__env->startSection('page-title', __('admin.material_manage')); ?>
<?php $__env->startSection('isMateri', 'active'); ?>

<?php $__env->startSection('custom-style-library'); ?>
	<link href="<?php echo e(asset('vendor/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<div class="row">
	<div class="col-12">
	<?php if(session()->get('success')): ?>
		<div class="alert alert-success fade show">
			<?php echo e(session()->get('success')); ?>

			<button class="close" data-dismiss="alert">&times;</button>
		</div>
	<?php elseif(session()->get('failed')): ?>
		<div class="alert alert-danger fade show">
		    <?php echo e(session()->get('failed')); ?>

		    <button class="close" data-dismiss="alert">&times;</button>
		</div>
	<?php endif; ?>
		<div class="card border-left-primary mb-5">
			<div class="card-body">
				<div class="row col justify-content-between mb-3">
					<h5 class="card-title text-primary font-weight-bold my-auto"><?php echo e(__('admin.material_list')); ?></h5>
					<button class="btn btn-outline-primary" data-toggle="modal" data-target="#add-materi-modal">
						<?php echo e(__('admin.material_add')); ?>

					</button>
				</div>

				<div class="table-responsive">
					<table class="table table-striped table-hover datatables">
						<thead>
							<tr>
								<th><?php echo e(__('admin.no')); ?></th>
								<th><?php echo e(__('admin.video_title')); ?></th>
								<th><?php echo e(__('admin.video')); ?></th>
								<th class="text-center" style="width: 80px"><?php echo e(__('admin.actions')); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php $no = 1 ?>
						<?php $__currentLoopData = $materis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($no); ?>.</td>
								<td><?php echo e($materi->judul_materi); ?></td>
								<td><?php echo e($materi->filename); ?></td>
								<td class="d-flex align-items-center justify-content-center">
									<a href="<?php echo e(route('materi.show', $materi->id_materi)); ?>">
										<i class="fas fa-info-circle" title="<?php echo e(__('admin.detail')); ?>" data-toggle="tooltip"></i>
									</a>

									<a href="<?php echo e(route('materi.edit', $materi->id_materi)); ?>">
										<i class="fas fa-edit ml-3" title="<?php echo e(__('admin.edit')); ?>" data-toggle="tooltip"></i>
									</a>

									<form method="POST" action="<?php echo e(route('materi.destroy', $materi->id_materi)); ?>"
										  onsubmit="return confirm('<?php echo e(__('admin.confirm_delete_material')); ?>')">
										<?php echo csrf_field(); ?>
										<?php echo method_field('DELETE'); ?>

										<button class="btn">
											<i class="fas fa-trash text-danger" title="<?php echo e(__('admin.delete')); ?>" data-toggle="tooltip"></i>
										</button>
									</form>
								</td>
							</tr>
							<?php $no++ ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal-content'); ?>

<div class="modal fade" id="add-materi-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo e(__('admin.material_add')); ?></h5>
			</div>

			<div class="modal-body">
				<div class="alert alert-success d-none">
					<?php echo e(__('admin.upload_success')); ?>

					<button class="close" data-dismiss="alert">&times;</button>
				</div>

				<div class="alert alert-danger d-none">
					<?php echo e(__('admin.upload_failed')); ?>

					<button class="close" data-dismiss="alert">&times;</button>
				</div>

				<form method="POST" action="<?php echo e(route('materi.store')); ?>" id="upload-form">
					<?php echo csrf_field(); ?>

					<div class="form-group">
						<label class="control-label"><?php echo e(__('admin.video_title')); ?></label>
						<input type="text" name="judul_materi" class="form-control" maxlength="191" required>
					</div>

					<div class="form-group">
						<label class="control-label"><?php echo e(__('admin.video')); ?></label>
						<div class="input-group">
							<div class="custom-file">
								<input type="hidden" name="filename">
								<input type="file" name="video" class="custom-file-input" id="video-upload"
									   data-url="<?php echo e(route('materi.handleUpload')); ?>" accept="video/*" required>
								<label class="custom-file-label" id="upload-video-label"
									   style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
									<?php echo e(__('admin.choose_video')); ?>

								</label>
							</div>
							<div class="input-group-append" id="container-upload-btn"></div>
						</div>

						<small class="form-text text-muted"><?php echo e(__('admin.upload_hint_short')); ?></small>

						<div class="progress progress-sm d-none">
							<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>

					<div class="form-group">
						<a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger float-right mr-2">
							<?php echo e(__('admin.cancel')); ?>

						</a>
					</div>

				</form>
			</div>

		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('necessary-library'); ?>
<script src="<?php echo e(asset('vendor/datatables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-file-upload/vendor/jquery.ui.widget.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-file-upload/jquery.iframe-transport.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-file-upload/jquery.fileupload.js')); ?>"></script>
<script src="<?php echo e(asset('js/fileupload-process.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/pages/materi.blade.php ENDPATH**/ ?>