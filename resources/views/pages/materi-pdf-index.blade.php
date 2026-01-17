@extends('layout.app')

@section('site-title', __('admin.materi_pdf'))
@section('page-title', __('admin.materi_pdf_manage'))
@section('isMateriPdf', 'active')

@section('main-content')
<div class="card border-left-primary mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>{{ __('admin.materi_pdf_list') }}</span>
        <a href="{{ route('materi-pdf.create') }}" class="btn btn-primary btn-sm">
            {{ __('admin.materi_pdf_add') }}
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered datatables">
            <thead>
                <tr>
                    <th style="width: 60px;">{{ __('admin.no') }}</th>
                    <th>{{ __('admin.pdf_title') }}</th>
                    <th>{{ __('admin.file') }}</th>
                    <th style="width: 140px;">{{ __('admin.actions') }}</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($materiPdfs as $index => $materi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $materi->judul_materi }}</td>
                    <td>{{ $materi->filename }}</td>
                    <td>
                        <a href="{{ route('materi-pdf.show', $materi->id_materi) }}"
                           class="btn btn-info btn-sm" title="{{ __('admin.detail') }}">
                            <i class="fas fa-info-circle"></i>
                        </a>

                        <a href="{{ route('materi-pdf.edit', $materi->id_materi) }}"
                           class="btn btn-primary btn-sm" title="{{ __('admin.edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('materi-pdf.destroy', $materi->id_materi) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('{{ __('admin.confirm_delete_pdf') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="{{ __('admin.delete') }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
