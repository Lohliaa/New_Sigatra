@extends('layouts.admin')
@section('title', 'Read SK')
@section('content')
<h1 class="mt-4">SK </h1>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    <strong>Data SK Guru Pegawai Yayasan Permata Mojokerto</strong>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <table class="table table-bordered table-striped">
        <tr>
            <th>No SK</th>
            <td>{{ $sk->no_sk }}</td>
        </tr>
        <tr>
            <th>No Tambahan</th>
            <td>{{ $sk->no_tambahan }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $sk->nama }}</td>
        </tr>
        <tr>
            <th>Gelar</th>
            <td>{{ $sk->gelar }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $sk->tempat_lahir }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $sk->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>NIPY</th>
            <td>{{ $sk->nipy }}</td>
        </tr>
        <tr>
            <th>Gol Ruang</th>
            <td>{{ $sk->gol_ruang }}</td>
        </tr>
        <tr>
            <th>Status Kepegawaian</th>
            <td>{{ $sk->status_kepegawaian }}</td>
        </tr>
        <tr>
            <th>Unit Kerja</th>
            <td>{{ $sk->unit_kerja }}</td>
        </tr>
        <tr>
            <th>TMT</th>
            <td>{{ $sk->tmt }}</td>
        </tr>
        <tr>
            <th>Tanggal Mulai</th>
            <td>{{ $sk->tanggal_mulai }}</td>
        </tr>
        <tr>
            <th>Berlaku</th>
            <td>{{ $sk->berlaku }}</td>
        </tr>
        <tr>
            <th>Tanggal Akhir</th>
            <td>{{ $sk->tanggal_akhir }}</td>
        </tr>
        <tr>
            <th>Tanggal Ditetapkan</th>
            <td>{{ $sk->tanggal_ditetapkan }}</td>
        </tr>
    </table>

    <div class="d-flex justify-content-end">
        <a href="{{ route('sk.index') }}" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>
</div>

@endsection