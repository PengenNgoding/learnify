@extends('layout.app')

@section('site-title', __('ui.material'))
@section('page-title', __('ui.material_detail'))
@section('isMateri', 'active')

@section('custom-style-library')
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
<style>
    .video-container { position: relative; max-width: 960px; margin: 0 auto; }
    .locked-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none; }
    .locked-overlay-card { pointer-events: auto; background: rgba(15, 23, 42, 0.95); border-radius: 16px; padding: 20px 24px; max-width: 380px; width: 90%; color: #f9fafb; box-shadow: 0 18px 45px rgba(0, 0, 0, 0.55); text-align: left; }
    .locked-overlay-title { font-size: 0.95rem; letter-spacing: 0.04em; text-transform: uppercase; color: #9ca3af; margin-bottom: 4px; }
    .locked-overlay-main { font-size: 1.05rem; font-weight: 600; margin-bottom: 12px; }
    .locked-overlay-price { font-size: 0.95rem; margin-bottom: 14px; color: #e5e7eb; }
    .locked-overlay-price span { font-weight: 700; color: #34d399; }
    .locked-overlay small { font-size: 0.8rem; color: #9ca3af; }
    .locked-overlay .input-group-text { background-color: #111827; border-color: #374151; color: #9ca3af; }
    .locked-overlay .form-control { background-color: #020617; border-color: #374151; color: #e5e7eb; }
    .locked-overlay .form-control:focus { background-color: #020617; border-color: #6ee7b7; box-shadow: 0 0 0 0.15rem rgba(34, 197, 94, 0.35); color: #f9fafb; }
    .plyr.plyr--video.video-locked .plyr__controls,
    .plyr.plyr--video.video-locked .plyr__control--overlaid { display: none !important; }
</style>
@endsection

@section('main-content')

@php
    $hasAccess = $hasAccess ?? false;
    $freeUsed  = $freeUsed  ?? 0;
    $harga     = 10000; // Rp10.000 per video
@endphp

<div class="row">
    <div class="col-12">
        <div class="card border-left-primary mb-5">
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('materi.index') }}" class="row col align-items-center">
                        <i class="fa fa-angle-left fa-lg mr-3"></i>
                        <h5 class="card-title my-auto text-primary font-weight-bold">
                            {{ $materi->judul_materi }}
                        </h5>
                    </a>
                </div>

                {{-- Banner info di atas video --}}
                @if(!$hasAccess)
                    <div class="alert alert-info mb-4">
                        @if($freeUsed < 2)
                            {!! __('ui.material_free_info', [
                                'left' => 2 - $freeUsed,
                                'price' => 'Rp' . number_format($harga, 0, ',', '.')
                            ]) !!}
                        @else
                            {!! __('ui.material_free_empty', [
                                'price' => 'Rp' . number_format($harga, 0, ',', '.')
                            ]) !!}
                        @endif
                    </div>
                @endif

                <div class="video-container">
                    <video id="player" class="video-max-height" controls>
                        <source src="{{ url('/getVidMateri/' . $materi->id_materi) }}">
                    </video>

                    @if(!$hasAccess)
                        <div class="locked-overlay">
                            <div class="locked-overlay-card">
                                <div class="locked-overlay-title">
                                    {{ __('ui.locked_title') }}
                                </div>
                                <div class="locked-overlay-main">
                                    {{ __('ui.locked_desc') }}
                                </div>

                                {{-- notif error / sukses --}}
                                @if(session('payment_error'))
                                    <div class="alert alert-danger py-1 px-2 mb-2">
                                        {{ session('payment_error') }}
                                    </div>
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success py-1 px-2 mb-2">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($freeUsed < 2)
                                    <p class="locked-overlay-price mb-3">
                                        {{ __('ui.have_free_quota') }}
                                        <br><small>{{ __('ui.free_quota_left', ['left' => 2 - $freeUsed]) }}</small>
                                    </p>

                                    <form method="POST" action="{{ route('materi.pay', $materi->id_materi) }}">
                                        @csrf
                                        <input type="hidden" name="mode" value="free">
                                        <button type="submit" class="btn btn-success btn-block">
                                            {{ __('ui.unlock_using_quota') }}
                                        </button>
                                    </form>
                                @else
                                    <p class="locked-overlay-price">
                                        {{ __('ui.access_price') }}
                                        <span>Rp{{ number_format($harga, 0, ',', '.') }}</span>
                                        <br><small>{{ __('ui.min_amount', ['price' => 'Rp' . number_format($harga, 0, ',', '.')]) }}</small>
                                    </p>

                                    <form method="POST" action="{{ route('materi.pay', $materi->id_materi) }}">
                                        @csrf
                                        <input type="hidden" name="mode" value="paid">

                                        <div class="form-group mb-3">
                                            <label for="amount" class="mb-1">{{ __('ui.payment_amount') }}</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input
                                                    type="number"
                                                    min="0"
                                                    name="amount"
                                                    id="amount"
                                                    class="form-control text-right"
                                                    placeholder="{{ __('ui.payment_example') }}"
                                                    value="{{ old('amount') }}"
                                                    required
                                                >
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('ui.pay_and_unlock') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('necessary-library')
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
<script>
    $(function () {
        const player = new Plyr('#player');

        player.on('enterfullscreen', () => {
            $('#player').removeClass('video-max-height');
        });

        player.on('exitfullscreen', () => {
            $('#player').addClass('video-max-height');
        });

        @if(!$hasAccess)
        player.on('ready', () => {
            player.pause();

            const wrapper = $('#player').closest('.plyr');
            wrapper.addClass('video-locked');
        });

        player.on('play', () => {
            player.pause();
        });
        @endif
    });
</script>
@endsection
