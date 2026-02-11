 @extends('layouts.admin')
 @section('title', 'Data Pegawai')
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
                     <strong>Edit Pejabat</strong>
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
                     <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPejabat">
                         <i class="bi bi-plus-circle"></i>
                     </button>

                     <!-- Modal Button Tambah -->
                     <div class="modal fade" id="modalTambahPejabat" tabindex="-1" aria-labelledby="modalTambahPejabat" aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <form action="{{ route('pejabat.store') }}" method="POST">
                                     @csrf

                                     <div class="modal-header">
                                         <h5 class="modal-title" id="modalTambahPejabat">
                                             Tambah Pejabat
                                         </h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>

                                     <div class="modal-body">
                                         <input type="hidden" name="id" id="id">

                                         <div class="mb-3">
                                             <label>Nama</label>
                                             <input type="text" name="nama" class="form-control">
                                         </div>

                                         <div class="mb-3">
                                             <label>Jabatan</label>
                                             <input type="text" name="jabatan" class="form-control">
                                         </div>

                                         <div class="mb-3">
                                             <label>Status</label>
                                             <input type="text" name="status" class="form-control">
                                         </div>
                                         <div class="mb-3">
                                             <label>Unit</label>
                                             <input type="text" name="unit" class="form-control">
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
                                 <th>Nama</th>
                                 <th>Jabatan</th>
                                 <th>Status</th>
                                 <th>Unit</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>

                         <tbody>
                             <?php $no = 1 ?>
                             @foreach ($pejabat as $h)
                             <tr id="tr_{{ $h->id }}">
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $h->nama }}</td>
                                 <td>{{ $h->jabatan }}</td>
                                 <td>{{ $h->status }}</td>
                                 <td>{{ $h->unit }}</td>
                                 <td>
                                     <div class="d-flex">
                                         <form id="deleteForm_{{ $h->id }}" action="{{ route('pejabat.destroy', $h->id) }}"
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

                                                     <form action="{{ route('pejabat.update', $h->id) }}" method="POST">
                                                         @csrf
                                                         @method('PUT')

                                                         <div class="modal-header">
                                                             <h5 class="modal-title" id="modalEditLabel{{ $h->id }}">
                                                                 Edit Pejabat
                                                             </h5>
                                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                         </div>

                                                         <div class="modal-body">
                                                             <div class="mb-3">
                                                                 <label class="form-label">Nama</label>
                                                                 <input type="text" name="nama" class="form-control" value="{{ $h->nama }}" required>
                                                             </div>
                                                             <div class="mb-3">
                                                                 <label class="form-label">Jabatan</label>
                                                                 <input type="text" name="jabatan" class="form-control" value="{{ $h->jabatan }}" required>
                                                             </div>
                                                             <div class="mb-3">
                                                                 <label class="form-label">Status</label>
                                                                 <input type="text" name="status" class="form-control" value="{{ $h->status }}" required>
                                                             </div>
                                                             <div class="mb-3">
                                                                 <label class="form-label">Unit</label>
                                                                 <input type="text" name="unit" class="form-control" value="{{ $h->unit }}" required>
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
             text: "Seluruh data data pegawai akan dihapus permanen!",
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