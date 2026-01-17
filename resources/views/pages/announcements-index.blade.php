@extends('layout.app')

@section('site-title', __('admin.announcements'))
@section('page-title', __('admin.announcements_list'))

@section('main-content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card border-left-primary mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.announcements_list') }}</h6>

                <a href="{{ route('announcements.create') }}" class="btn btn-sm btn-primary">
                    + {{ __('admin.add_announcement') }}
                </a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">{{ __('admin.no') }}</th>
                            <th>{{ __('admin.title') }}</th>
                            <th>{{ __('admin.active') }}</th>
                            <th>{{ __('admin.start_date') }}</th>
                            <th>{{ __('admin.end_date') }}</th>
                            <th width="15%">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($announcements as $index => $a)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $a->judul }}</td>
                                <td>
                                    @if($a->is_active)
                                        <span class="badge badge-success">{{ __('admin.status_active') }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ __('admin.status_inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ optional($a->tanggal_mulai)->format('d-m-Y H:i') }}</td>
                                <td>{{ optional($a->tanggal_selesai)->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('announcements.edit', $a->id) }}"
                                       class="btn btn-sm btn-warning">{{ __('admin.edit') }}</a>

                                    <form action="{{ route('announcements.destroy', $a->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('{{ __('admin.confirm_delete_announcement') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">{{ __('admin.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ __('admin.no_announcements') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
