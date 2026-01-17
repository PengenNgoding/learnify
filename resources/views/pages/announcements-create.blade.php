@extends('layout.app')

@section('site-title', __('admin.announcements'))
@section('page-title', __('admin.announcements_create'))

@section('main-content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-left-primary mb-4">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('announcements.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>{{ __('admin.title') }}</label>
                        <input type="text" name="judul" class="form-control"
                               value="{{ old('judul') }}" required>
                        @error('judul')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.announcement_content') }}</label>
                        <textarea name="isi" rows="5" class="form-control" required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    @php
                        // datetime-local butuh format: YYYY-MM-DDTHH:MM
                        $oldMulai = old('tanggal_mulai');
                        $oldSelesai = old('tanggal_selesai');

                        $mulaiVal = $oldMulai ? \Illuminate\Support\Str::of($oldMulai)->replace(' ', 'T')->substr(0, 16) : '';
                        $selesaiVal = $oldSelesai ? \Illuminate\Support\Str::of($oldSelesai)->replace(' ', 'T')->substr(0, 16) : '';
                    @endphp

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('admin.start_date_optional') }}</label>
                            <input type="datetime-local" name="tanggal_mulai"
                                   class="form-control"
                                   value="{{ $mulaiVal }}">
                            @error('tanggal_mulai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ __('admin.end_date_optional') }}</label>
                            <input type="datetime-local" name="tanggal_selesai"
                                   class="form-control"
                                   value="{{ $selesaiVal }}">
                            @error('tanggal_selesai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-check">
                        <input type="hidden" name="is_active" value="0">

                        <input type="checkbox" name="is_active" id="is_active"
                               class="form-check-input" value="1"
                               {{ old('is_active', 1) ? 'checked' : '' }}>

                        <label for="is_active" class="form-check-label">{{ __('admin.active') }}</label>

                        @error('is_active')
                            <br><small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
                    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
