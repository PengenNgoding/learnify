@extends('layout.app')

@section('site-title', __('admin.materi_pdf'))
@section('page-title', __('admin.materi_pdf_create'))
@section('isMateriPdf', 'active')

@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card border-left-primary mb-5">
            <div class="card-body">
                <form method="POST"
                      action="{{ route('materi-pdf.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- JUDUL PDF --}}
                    <div class="form-group">
                        <label class="control-label">{{ __('admin.pdf_title') }}</label>
                        <input type="text"
                               name="judul_materi"
                               class="form-control @error('judul_materi') is-invalid @enderror"
                               value="{{ old('judul_materi') }}"
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
                                <input type="file"
                                       name="file_pdf"
                                       class="custom-file-input @error('file_pdf') is-invalid @enderror"
                                       id="file_pdf"
                                       accept="application/pdf"
                                       required>
                                <label class="custom-file-label" for="file_pdf">
                                    {{ __('admin.choose_pdf') }}
                                </label>
                            </div>
                        </div>
                        <small class="form-text text-muted">
                            {{ __('admin.pdf_hint') }}
                        </small>
                        @error('file_pdf')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TOMBOL --}}
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
    $(function () {
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label')
                .addClass("selected")
                .html(fileName);
        });
    });
</script>
@endsection
