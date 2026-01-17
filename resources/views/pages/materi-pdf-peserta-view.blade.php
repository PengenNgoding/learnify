@extends('layout.app')

@section('site-title', __('ui.pdf_detail'))
@section('page-title', __('ui.pdf_detail'))
@section('isMateriPdfPeserta', 'active')

@section('main-content')
<div class="row">
    <div class="col-12 mb-3 d-flex align-items-center">
        <a href="{{ route('materi-pdf.peserta.index') }}" class="mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4 class="mb-0">{{ $materi->judul_materi }}</h4>
    </div>

    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body" style="height: 80vh;">
                <iframe
                    src="{{ route('materi-pdf.file', $materi->id_materi) }}"
                    style="width: 100%; height: 100%; border: none;"
                ></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
