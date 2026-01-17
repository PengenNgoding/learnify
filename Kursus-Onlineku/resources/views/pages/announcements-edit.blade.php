@extends('layout.app')

@section('site-title', __('admin.announcements'))
@section('page-title', __('admin.announcements_edit'))

@section('main-content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-left-primary mb-4">
            <div class="card-body">
                <form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>{{ __('admin.title') }}</label>
                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="{{ old('judul', $announcement->judul) }}"
                            required
                        >
                        @error('judul')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.announcement_content') }}</label>
                        <textarea
                            name="isi"
                            rows="5"
                            class="form-control"
                            required
                        >{{ old('isi', $announcement->isi) }}</textarea>
                        @error('isi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('admin.start_date_optional') }}</label>
                            <input
                                type="datetime-local"
                                name="tanggal_mulai"
                                class="form-control"
                                value="{{ old('tanggal_mulai', optional($announcement->tanggal_mulai)->format('Y-m-d\TH:i')) }}"
                            >
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ __('admin.end_date_optional') }}</label>
                            <input
                                type="datetime-local"
                                name="tanggal_selesai"
                                class="form-control"
                                value="{{ old('tanggal_selesai', optional($announcement->tanggal_selesai)->format('Y-m-d\TH:i')) }}"
                            >
                        </div>
                    </div>

                    <div class="form-group form-check">
                        <input
                            type="checkbox"
                            name="is_active"
                            id="is_active"
                            class="form-check-input"
                            value="1"
                            {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}
                        >
                        <label for="is_active" class="form-check-label">{{ __('admin.active') }}</label>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
