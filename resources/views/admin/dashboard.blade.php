@extends('layouts.admin')
@section('content')

<h1 class="mt-4">Dashboard {{ Auth::user()->name }} </h1>
<!-- <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol> -->

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Primary Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Warning Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Success Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Danger Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- ===================== -->
        <!-- TABEL MOU -->
        <!-- ===================== -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Data MoU</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gelar</th>
                                    <th>Tanggal MoU</th>
                                    <th>Unit Kerja</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($mou as $h)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $h->nama }}</td>
                                    <td>{{ $h->gelar }}</td>
                                    <td>{{ $h->tgl_mou }}</td>
                                    <td>{{ $h->unit_kerja }}</td>
                                    <td>{{ $h->tgl_mulai }}</td>
                                    <td>{{ $h->tanggal_akhir }}</td>
                                    <td>
                                        <a href="{{ route('mou.show', $h->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- TABEL SK -->
        <!-- ===================== -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Data SK</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gelar</th>
                                    <th>Status Kepegawaian</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($sk as $s)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->gelar }}</td>
                                    <td>{{ $s->status_kepegawaian }}</td>
                                    <td>{{ $s->tanggal_mulai }}</td>
                                    <td>{{ $s->tanggal_akhir }}</td>
                                    <td>
                                        <a href="{{ route('sk.show', $s->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection