@extends('layout.app')

@section('site-title', __('app.announcements'))
@section('page-title', __('app.announcement_detail'))

@section('main-content')
<div class="card border-left-primary">
    <div class="card-body">
        <h4 class="mb-2">{{ $announcement->judul }}</h4>

        <div class="text-muted mb-3">
            {{ $announcement->created_at->format('d M Y H:i') }}
        </div>

        <div style="white-space: pre-wrap;">{{ $announcement->isi }}</div>

        <a href="{{ route('announcements.peserta.index') }}" class="btn btn-secondary mt-3">
            {{ __('app.back') }}
        </a>
    </div>
</div>
@endsection
