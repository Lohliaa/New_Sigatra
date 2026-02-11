 @extends('layouts.admin')
@section('title', 'MOU')
@section('content')

<h1 class="mt-4"></h1>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                @if(session('success'))
                <script>
                    Swal.fire('Sukses', '{{ session("success") }}', 'success');
                </script>
                @endif

                <div>
                    <i class="fas fa-table me-1"></i>
                    <strong>Data MoU Guru Pegawai Yayasan Permata Mojokerto</strong>
                </div>

                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header bg-danger text-white border-0">
                                <h5 class="modal-title fw-bold" id="deleteModalLabel">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Konfirmasi Hapus
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body text-center py-4">
                                <p class="fs-5 mb-0">Apakah Anda yakin ingin menghapus data ini?</p>
                            </div>

                            <div class="modal-footer justify-content-center border-0 pb-4">
                                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger px-4" id="confirmDelete">
                                    <i class="bi bi-trash3 me-1"></i> Ya, Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex align-items-center gap-2 mt-2">
                    <button type="button" id="btnDeleteAll" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                    <form id="deleteAllForm" action="{{ route('mou.destroy_all') }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- Tombol Export -->
                    <form action="{{ route('mou.export') }}" method="GET" class="mb-0">
                        <button type="submit" class="btn btn-dark btn-sm d-flex align-items-center justify-content-center">
                            <i class="bi bi-download fs-6"></i>
                        </button>
                    </form>

                    <!-- Form Upload -->
                    <form action="{{ route('mou.upload.process') }}" method="POST" enctype="multipart/form-data" id="uploadForm" class="mb-0">
                        @csrf
                        <input type="file" name="file" id="fileInput" class="d-none" required>

                        <button
                            type="button"
                            class="btn btn-secondary btn-sm d-flex align-items-center justify-content-center"
                            onclick="document.getElementById('fileInput').click();"
                            title="Upload File Excel">
                            <i class="bi bi-upload fs-6"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>No SK</th>
                                <th>No Tambahan</th>
                                <th>Status Kepegawaian</th>
                                <th>Status Detail</th>
                                <th>Nama</th>
                                <th>Gelar</th>
                                <th>Hari Kerja</th>
                                <th>Jam Kerja</th>
                                <th>Alamat</th>
                                <th>Hari</th>
                                <th>Tanggal MoU</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Unit Kerja</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan Jabatan</th>
                                <th>Tunjangan Transport</th>
                                <th>Tunjangan Kinerja</th>
                                <th>Tunjangan Fungsional</th>
                                <th>THP</th>
                                <th>Terbilang</th>
                                <th>Tanggal Mulai</th>
                                <th>Berlaku</th>
                                <th>Tanggal Akhir</th>
                                <th>Saksi 1</th>
                                <th>Saksi 2</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($mou as $h)
                            <tr id="tr_{{ $h->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $h->no_sk }}</td>
                                <td>{{ $h->no_tambahan }}</td>
                                <td>{{ $h->status_kepegawaian }}</td>
                                <td>{{ $h->status_detail }}</td>
                                <td>{{ $h->nama }}</td>
                                <td>{{ $h->gelar }}</td>
                                <td>{{ $h->hari_kerja }}</td>
                                <td>{{ $h->jam_kerja }}</td>
                                <td>{{ $h->alamat }}</td>
                                <td>{{ $h->hari }}</td>
                                <td>{{ $h->tgl_mou }}</td>
                                <td>{{ $h->tempat_lahir }}</td>
                                <td>{{ $h->tanggal_lahir }}</td>
                                <td>{{ $h->unit_kerja }}</td>
                                <td>{{ $h->gaji_pokok }}</td>
                                <td>{{ $h->tunjangan_jabatan }}</td>
                                <td>{{ $h->tunjangan_transport }}</td>
                                <td>{{ $h->tunjangan_kinerja }}</td>
                                <td>{{ $h->tunjangan_fungsional }}</td>
                                <td>{{ $h->thp }}</td>
                                <td>{{ $h->terbilang }}</td>
                                <td>{{ $h->tgl_mulai }}</td>
                                <td>{{ $h->berlaku }}</td>
                                <td>{{ $h->tanggal_akhir }}</td>
                                <td>{{ $h->saksi1 }}</td>
                                <td>{{ $h->saksi2 }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form id="deleteForm_{{ $h->id }}" action="{{ route('mou.destroy', $h->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $h->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('mou.show', $h->id) }}" class="btn btn-warning mr-2">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('mou.edit', $h->id) }}" class="btn btn-primary mr-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
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

<script>
    // Submit form otomatis saat file dipilih
    document.getElementById('fileInput').addEventListener('change', function() {
        if (this.files.length > 0) {
            document.getElementById('uploadForm').submit();
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new simpleDatatables.DataTable("#datatablesSimple", {
            perPage: 10, // jumlah data per halaman
            perPageSelect: [5, 10, 25, 50],
            labels: {
                placeholder: "Cari...",
                perPage: "",
                noRows: "Data tidak ditemukan",
                info: "Menampilkan {start} - {end} dari {rows} data",
            },
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal');
        var confirmDeleteButton = document.getElementById('confirmDelete');
        var formToSubmit;

        if (deleteModal && confirmDeleteButton) {
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                formToSubmit = document.getElementById('deleteForm_' + id);
            });

            confirmDeleteButton.addEventListener('click', function() {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });
        }
    });
</script>
<script>
    document.getElementById('btnDeleteAll').addEventListener('click', function() {
        Swal.fire({
            title: 'Hapus Semua Data?',
            text: "Seluruh data MOU akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAllForm').submit();
            }
        });
    });
</script>


@endsection