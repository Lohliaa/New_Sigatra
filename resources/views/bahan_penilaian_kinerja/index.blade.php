 @extends('layouts.admin')
 @section('title', 'Bahan Penilaian Kinerja')
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
                     <strong>Bahan Penilaian Kinerja Guru Pegawai Yayasan Permata Mojokerto</strong>
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

                     <!-- Button Tambah -->
                     <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBahanPenilaian">
                         <i class="bi bi-plus-circle"></i>
                     </button>

                     <!-- Modal Button Tambah -->
                     <div class="modal fade" id="modalTambahBahanPenilaian" tabindex="-1" aria-labelledby="modalTambahBahanPenilaianLabel" aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <form action="{{ route('bahan_penilaian.store') }}" method="POST">
                                     @csrf

                                     <div class="modal-header">
                                         <h5 class="modal-title" id="modalTambahBahanPenilaianLabel">
                                             Tambah Bahan Penilaian
                                         </h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>

                                     <div class="modal-body">
                                         <div class="mb-3">
                                             <label for="link" class="form-label">Link Bahan Penilaian</label>
                                             <input type="url" name="link" class="form-control" placeholder="https://..." required>
                                         </div>
                                     </div>

                                     <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                         <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                     </div>

                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                         <thead class="table-light text-center">
                             <tr>
                                 <th>No</th>
                                 <th>Link Bahan Penilaian Kinerja</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>

                         <tbody>
                             <?php $no = 1 ?>
                             @foreach ($bahan_penilaian as $h)
                             <tr id="tr_{{ $h->id }}">
                                 <td>{{ $no++ }}</td>
                                 <td> <a href="{{ $h->link }}" target="_blank" rel="noopener noreferrer">
                                         {{ $h->link }}
                                     </a>
                                 </td>
                                 <td>
                                     <div class="d-flex">
                                         <form id="deleteForm_{{ $h->id }}" action="{{ route('bahan_penilaian.destroy', $h->id) }}"
                                             method="POST">
                                             @csrf
                                             @method('DELETE')
                                             <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                                 data-bs-target="#deleteModal" data-id="{{ $h->id }}">
                                                 <i class="bi bi-trash3"></i>
                                             </button>
                                         </form>

                                         <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $h->id }}">
                                             <i class="bi bi-pencil-square"></i>
                                         </a>
                                         <!-- Modal Button Edit -->
                                         <div class="modal fade" id="modalEdit{{ $h->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $h->id }}" aria-hidden="true">
                                             <div class="modal-dialog">
                                                 <div class="modal-content">

                                                     <form action="{{ route('bahan_penilaian.update', $h->id) }}" method="POST">
                                                         @csrf
                                                         @method('PUT')

                                                         <div class="modal-header">
                                                             <h5 class="modal-title" id="modalEditLabel{{ $h->id }}">
                                                                 Edit Bahan Penilaian
                                                             </h5>
                                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                         </div>

                                                         <div class="modal-body">
                                                             <div class="mb-3">
                                                                 <label class="form-label">Link Bahan Penilaian</label>
                                                                 <input type="url" name="link" class="form-control" value="{{ $h->link }}" required>
                                                             </div>
                                                         </div>

                                                         <div class="modal-footer">
                                                             <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                             <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                         </div>

                                                     </form>

                                                 </div>
                                             </div>
                                         </div>
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
             text: "Seluruh data bahan_penilaian akan dihapus permanen!",
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