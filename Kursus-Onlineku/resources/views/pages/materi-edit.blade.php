@extends('layout.app')

@section('site-title', __('admin.material'))
@section('page-title', __('admin.edit_material'))
@section('isMateri', 'active')

@section('main-content')

<div class="row">
	<div class="col-12">
		<div class="card border-left-primary mb-5">
			<div class="card-body">
				<form method="POST" action="{{ route('materi.update', $materi->id_materi) }}" id="upload-form" enctype="multipart/form-data">
					@csrf
					@method('PATCH')

					<div class="form-group">
						<label class="control-label">{{ __('admin.material_title') }}</label>
						<input type="text" name="judul_materi"
							   class="form-control @error('judul_materi') is-invalid @enderror"
							   value="{{ $materi->judul_materi }}" required>
						@error('judul_materi')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<label class="control-label">{{ __('admin.video') }}</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="hidden" name="old_filename" value="{{ $materi->filename }}">
								<input type="hidden" name="filename">
								<input type="file" name="video" class="custom-file-input" id="video-upload"
									   data-url="{{ route('materi.handleUpload') }}" accept="video/*">
								<label class="custom-file-label" id="upload-video-label">{{ $materi->filename }}</label>
							</div>
							<div class="input-group-append" id="container-upload-btn"></div>
						</div>

						<small class="form-text text-muted">
							{{ __('admin.upload_hint') }}<br>
						</small>

						<div class="progress progress-sm d-none">
							<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>

						@error('filename')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<button class="btn btn-primary float-right">{{ __('admin.save') }}</button>
						<a href="{{ route('materi.index') }}" data-dismiss="modal" class="btn btn-danger float-right mr-2">
							{{ __('admin.cancel') }}
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('necessary-library')
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-file-upload/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('vendor/jquery-file-upload/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('vendor/jquery-file-upload/jquery.fileupload.js') }}"></script>
<script src="{{ asset('js/fileupload-process.js') }}"></script>
@endsection
