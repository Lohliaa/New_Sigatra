@extends('layouts.admin')
@section('title', 'Read MOU')
@section('content')
<h1 class="mt-4">MoU </h1>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    <strong>Data MoU Guru Pegawai Yayasan Permata Mojokerto</strong>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <table class="table table-bordered table-striped">
        <tr>
            <th>No SK</th>
            <td>{{ $mou->no_sk }}</td>
        </tr>
        <tr>
            <th>No Tambahan</th>
            <td>{{ $mou->no_tambahan }}</td>
        </tr>
        <tr>
            <th>Status Kepegawaian</th>
            <td>{{ $mou->status_kepegawaian }}</td>
        </tr>
        <tr>
            <th>Status Detail</th>
            <td>{{ $mou->status_detail }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $mou->nama }}</td>
        </tr>
        <tr>
            <th>Gelar</th>
            <td>{{ $mou->gelar }}</td>
        </tr>
        <tr>
            <th>Hari Kerja</th>
            <td>{{ $mou->hari_kerja }}</td>
        </tr>
        <tr>
            <th>Jam Kerja</th>
            <td>{{ $mou->jam_kerja }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $mou->alamat }}</td>
        </tr>
        <tr>
            <th>Hari</th>
            <td>{{ $mou->hari }}</td>
        </tr>
        <tr>
            <th>Tanggal MoU</th>
            <td>{{ $mou->tgl_mou }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $mou->tempat_lahir }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $mou->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Unit Kerja</th>
            <td>{{ $mou->unit_kerja }}</td>
        </tr>
        <tr>
            <th>Gaji Pokok</th>
            <td>{{ $mou->gaji_pokok }}</td>
        </tr>
        <tr>
            <th>Tunjangan Jabatan</th>
            <td>{{ $mou->tunjangan_jabatan }}</td>
        </tr>
        <tr>
            <th>Tunjangan Transport</th>
            <td>{{ $mou->tunjangan_transport }}</td>
        </tr>
        <tr>
            <th>Tunjangan Kinerja</th>
            <td>{{ $mou->tunjangan_kinerja }}</td>
        </tr>
        <tr>
            <th>Tunjangan Fungsional</th>
            <td>{{ $mou->tunjangan_fungsional }}</td>
        </tr>
        <tr>
            <th>Total THP</th>
            <td>{{ $mou->thp }}</td>
        </tr>
        <tr>
            <th>Terbilang</th>
            <td>{{ $mou->terbilang }}</td>
        </tr>
        <tr>
            <th>Tanggal Mulai</th>
            <td>{{ $mou->tgl_mulai }}</td>
        </tr>
        <tr>
            <th>Masa Berlaku</th>
            <td>{{ $mou->berlaku }}</td>
        </tr>
        <tr>
            <th>Tanggal Akhir</th>
            <td>{{ $mou->tanggal_akhir }}</td>
        </tr>
        <tr>
            <th>Saksi 1</th>
            <td>{{ $mou->saksi1 }}</td>
        </tr>
        <tr>
            <th>Saksi 2</th>
            <td>{{ $mou->saksi2 }}</td>
        </tr>
    </table>

    <div class="d-flex justify-content-end">
        <a href="{{ route('mou.index') }}" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>
</div>

@endsection