@extends('layout.app')

@section('site-title', __('ui.history'))
@section('page-title', __('ui.history'))
@section('isHistory', 'active')

@section('custom-style-library')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
@endsection

@section('main-content')

@php
    $materis = $materis ?? collect();
    $materiPdfs = $materiPdfs ?? collect();
@endphp

<div class="row">
    {{-- HISTORY VIDEO --}}
    @foreach($materis as $materi)
        <div class="col-md-4 mb-4">
            <a href="{{ route('view-materi', $materi->id_materi) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden;">
                    <div class="col" style="padding:0; height:180px; overflow:hidden;">
                        <video class="player" style="width:100%; object-fit:cover;">
                            <source src="{{ route('materi.video', $materi->id_materi) }}">
                        </video>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-primary font-weight-bold mb-0">
                            {{ $materi->judul_materi }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach

    {{-- HISTORY PDF --}}
    @foreach($materiPdfs as $pdf)
        <div class="col-md-4 mb-4">
            <a href="{{ route('materi-pdf.peserta.show', $pdf->id_materi) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden;">
                    <div class="d-flex align-items-center justify-content-center"
                         style="height: 180px; background:#f5f7fb;">
                        <img src="{{ asset('assets/img/pdf.png') }}" alt="{{ __('ui.pdf') }}"
                             style="width: 70px; opacity:.9;">
                    </div>
                    <div class="card-body">
                        <p class="card-text text-primary font-weight-bold mb-0">
                            {{ $pdf->judul_materi }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach

    @if($materis->isEmpty() && $materiPdfs->isEmpty())
        <div class="col-12">
            <p>{{ __('ui.no_history') }}</p>
        </div>
    @endif
</div>

@endsection

@section('necessary-library')
    <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
    <script>
        $(function () {
            Plyr.setup('.player', {
                enabled: false,
            });
        });
    </script>
@endsection
