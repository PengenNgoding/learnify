@extends('layout.app')

@section('site-title', __('app.announcements'))
@section('page-title', __('app.announcements'))

@section('main-content')
<div class="card border-left-primary">
    <div class="card-body">
        @if($announcements->count() == 0)
            <div class="alert alert-info mb-0">{{ __('app.no_announcement') }}</div>
        @else
            <div class="list-group">
                @foreach($announcements as $a)
                    @php $isUnread = !in_array($a->id, $readIds); @endphp

                    <a href="{{ route('announcements.peserta.show', $a->id) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $isUnread ? 'font-weight-bold' : '' }}">
                        <div>
                            <div>{{ $a->judul }}</div>
                            <small class="text-muted">{{ $a->created_at->format('d M Y H:i') }}</small>
                        </div>

                        @if($isUnread)
                            <span class="badge badge-danger">{{ __('app.new') }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
