@extends('layout.app')

@section('site-title', __('ui.materi_pdf'))
@section('page-title', __('ui.materi_pdf'))
@section('isMateriPdfPeserta', 'active')

@section('main-content')

<div class="row">
    @forelse ($materiPdfs as $materi)
        <div class="col-md-4 mb-4">
            <a href="{{ route('materi-pdf.peserta.show', $materi->id_materi) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden;">
                    {{-- area thumbnail --}}
                    <div class="d-flex align-items-center justify-content-center"
                         style="height: 200px; background:#f5f7fb;">
                        <img src="{{ asset('assets/img/pdf.png') }}" alt="{{ __('ui.pdf') }}"
                             style="width: 80px; opacity: .9;">
                    </div>

                    {{-- judul --}}
                    <div class="card-body">
                        <p class="card-text text-primary font-weight-bold mb-0">
                            {{ $materi->judul_materi }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12">
            <p>{{ __('ui.no_pdf_materials') }}</p>
        </div>
    @endforelse
</div>

@endsection
