@extends('layout.app')

@section('site-title', __('admin.materi_pdf'))
@section('page-title', __('admin.materi_pdf_edit'))
@section('isMateriPdf', 'active')

@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card border-left-primary mb-5">
            <div class="card-body">

                <form method="POST"
                      action="{{ route('materi-pdf.update', $materiPdf->id_materi) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- JUDUL --}}
                    <div class="form-group">
                        <label class="control-label">{{ __('admin.pdf_title') }}</label>
                        <input type="text"
                               name="judul_materi"
                               class="form-control @error('judul_materi') is-invalid @enderror"
                               value="{{ old('judul_materi', $materiPdf->judul_materi) }}"
                               required>
                        @error('judul_materi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- FILE PDF --}}
                    <div class="form-group">
                        <label class="control-label">{{ __('admin.pdf_file') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="old_filename" value="{{ $materiPdf->filename }}">
                                <input type="file"
                                       name="file_pdf"
                                       class="custom-file-input @error('file_pdf') is-invalid @enderror"
                                       id="pdf-upload"
                                       accept="application/pdf">
                                <label class="custom-file-label" id="upload-pdf-label">
                                    {{ $materiPdf->filename ?? __('admin.choose_pdf') }}
                                </label>
                            </div>
                        </div>

                        <small class="form-text text-muted">
                            {{ __('admin.pdf_keep_empty_hint') }}
                        </small>

                        @error('file_pdf')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <div class="form-group">
                        <button class="btn btn-primary float-right">{{ __('admin.save') }}</button>
                        <a href="{{ route('materi-pdf.index') }}"
                           class="btn btn-danger float-right mr-2">{{ __('admin.cancel') }}</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('necessary-library')
<script>
    document.addEventListener('change', function (e) {
        if (e.target && e.target.id === 'pdf-upload') {
            const fallback = @json(__('admin.choose_pdf'));
            const fileName = e.target.files[0] ? e.target.files[0].name : fallback;
            document.getElementById('upload-pdf-label').innerText = fileName;
        }
    });
</script>
@endsection
