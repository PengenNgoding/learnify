@extends('layout.app')

@section('site-title', 'Tracking Pembelian')
@section('page-title', 'Tracking Pembelian Materi Video')

@section('main-content')
<div class="card border-left-primary mb-4">
    <div class="card-body">

        <h5 class="mb-4 font-weight-bold text-primary">
            Daftar Pembelian Materi Video
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>User ID</th>
                        <th>Nama</th>
                        <th>Materi</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $trx)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trx->user_id }}</td>
                            <td>{{ $trx->user->name ?? '-' }}</td>
                            <td>{{ $trx->materi->judul_materi ?? '-' }}</td>

                            {{-- Tipe: gratis / berbayar --}}
                            <td>
                                @if($trx->is_free)
                                    <span class="badge badge-success">Gratis (kuota)</span>
                                @else
                                    <span class="badge badge-primary">Berbayar</span>
                                @endif
                            </td>

                            <td>
                                @if($trx->status === 'sukses')
                                    <span class="badge badge-success">Sukses</span>
                                @else
                                    <span class="badge badge-danger">{{ $trx->status }}</span>
                                @endif
                            </td>

                            <td>
                                @if($trx->is_free)
                                    Rp0
                                @else
                                    Rp{{ number_format($trx->jumlah, 0, ',', '.') }}
                                @endif
                            </td>

                            <td>{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
