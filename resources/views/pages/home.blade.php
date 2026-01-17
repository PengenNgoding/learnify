@extends('layout.app')

@section('site-title', __('ui.dashboard'))
@section('page-title', __('ui.dashboard'))
@section('isDashboard', 'active')
{{-- ini dashboard, jangan nyalain menu pdf --}}
@section('isMateriPdfPeserta', '')

@section('custom-style-library')
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
@endsection

@section('main-content')

@php
    // Biar aman: kalau controller gak ngirim $materis, gak bakal error
    $materis = $materis ?? collect();
@endphp

<div class="row">
    <div class="col-12">
        <div class="card-columns">

            @forelse($materis as $materi)
                <a href="{{ route('view-materi', $materi->id_materi) }}" style="text-decoration:none;">
                    <div class="card mb-5">
                        <div class="col" style="padding: 0; height: 140px; overflow: hidden;">
                            <video class="player" playsinline muted style="width: 100%; height: 140px; object-fit: cover;">
                                <source src="{{ route('materi.video', $materi->id_materi) }}" type="video/mp4">
                            </video>
                        </div>

                        <div class="card-body">
                            <p class="card-text text-primary font-weight-bold">
                                {{ $materi->judul_materi }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="alert alert-info">
                    {{ __('ui.no_materials') }}
                </div>
            @endforelse

        </div>
    </div>
</div>

@endsection

@section('necessary-library')
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Plyr.setup('.player', {
        controls: [],
        clickToPlay: false
    });
});
</script>
@endsection
