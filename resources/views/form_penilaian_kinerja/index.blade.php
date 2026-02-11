 @extends('layouts.admin')
 @section('title', 'Form Penilaian Kinerja')
 @section('content')
 @php
 $user = auth()->user();
 @endphp
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
                     <strong>Form Penilaian Kinerja Guru Pegawai Yayasan Permata Mojokerto</strong>
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
                     <a href="{{ route('form_penilaian.create') }}" class="btn btn-primary btn-sm">
                         Tambah Penilaian
                     </a>
                 </div>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                         <thead class="table-light text-center">
                             <tr>
                                 <th>No</th>
                                 <th>Nama</th>
                                 <th>Status</th>
                                 <th>Unit</th>
                                 <th>Jabatan</th>
                                 <th>Penilai</th>
                                 <th>Jabatan Penilai</th>
                                 <th>Periode Penilaian</th>
                                 <th>Tanggal Penilaian</th>
                                 <th>Mempersiapkan kegiatan sesuai dengan uraian tugas kerja</th>
                                 <th>Melaksanakan tugas sesuai uraian tugas kerja</th>
                                 <th>Supervisor dan Evelator</th>
                                 <th>Memberikan layanan terhadap peserta didik</th>
                                 <th>Memberikan layanan terhadap orang tua dan atau rekan sejawat</th>
                                 <th>Sholat wajib berjamaah di masjid (LK), awal waktu (PR)</th>
                                 <th>Membaca Al Qur'an dengan tartil minimal 1 juz/hari</th>
                                 <th>Memiliki hafalan Al Qur'an (minimal 2 juz)</th>
                                 <th>Hadir dalam pembinaan pekanan Bina Pribadi Islami</th>
                                 <th>Memiliki kejujuran</th>
                                 <th>Tanggung jawab dan ketuntasan tugas</th>
                                 <th>Interaksi sosial</th>
                                 <th>Selalu hadir</th>
                                 <th>Datang tepat waktu</th>
                                 <th>Tertib dalam berseragam</th>
                                 <th>Mengikuti kegiatan koordinasi dan kelembagaan</th>
                                 <th>Komitmen kelembagaan</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>

                         <tbody>
                             <?php $no = 1 ?>
                             @foreach ($form_penilaian as $h)
                             <tr id="tr_{{ $h->id }}">
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $h->users->name ?? '-' }}</td>
                                 <td>{{ $h->users->unit ?? '-' }}</td>
                                 <td>{{ $h->users->status ?? '-' }}</td>
                                 <td>{{ $h->users->jabatan ?? '-' }}</td>
                                 <td>{{ $h->pejabat->nama ?? '-' }}</td>
                                 <td>{{ $h->pejabat->jabatan ?? '-' }}</td>
                                 <td>{{ $h->periodes->periode ?? '-' }}</td>
                                 <td>{{ $h->periodes->tanggal ?? '-' }}</td>
                                 <td>{{ $h->persiapan_tugas }}</td>
                                 <td>{{ $h->supervisor_evelator }}</td>
                                 <td>{{ $h->layanan_peserta_didik }}</td>
                                 <td>{{ $h->layanan_orangtua_rekan }}</td>
                                 <td>{{ $h->sholat_berjamaah }}</td>
                                 <td>{{ $h->baca_quran_harian }}</td>
                                 <td>{{ $h->hafalan_quran }}</td>
                                 <td>{{ $h->kehadiran_bpi }}</td>
                                 <td>{{ $h->kejujuran }}</td>
                                 <td>{{ $h->tanggung_jawab }}</td>
                                 <td>{{ $h->interaksi_sosial }}</td>
                                 <td>{{ $h->selalu_hadir }}</td>
                                 <td>{{ $h->datang_tepat_waktu }}</td>
                                 <td>{{ $h->tertib_berseragam }}</td>
                                 <td>{{ $h->koordinasi_kelembagaan }}</td>
                                 <td>{{ $h->komitmen_kelembagaan }}</td>
                                 <td>{{ $h->total }}</td>
                                 <td>{{ $h->rata_rata }}</td>
                                 <td>{{ $h->catatan }}</td>
                                 <td>
                                     <div class="d-flex gap-1">

                                         {{-- ADMIN: boleh hapus --}}
                                         @if ($user->role === 'admin')
                                         <form action="{{ route('form_penilaian.destroy', $h->id) }}" method="POST">
                                             @csrf
                                             @method('DELETE')
                                             <button class="btn btn-danger btn-sm">
                                                 <i class="bi bi-trash3"></i>
                                             </button>
                                         </form>
                                         @endif

                                         {{-- LOGIKA EDIT --}}
                                         @if (
                                         // ADMIN
                                         $user->role === 'admin'

                                         // KABID / KANIT satu unit
                                         || (
                                         in_array($user->role, ['kabid', 'kanit']) &&
                                         $user->unit === $h->user->unit
                                         )
                                         )
                                         <a href="{{ route('form_penilaian.edit', $h->id) }}" class="btn btn-primary btn-sm">
                                             <i class="bi bi-pencil-square"></i>
                                         </a>
                                         @endif

                                         {{-- STAF / GURU (hanya info) --}}
                                         @if (in_array($user->role, ['staf', 'guru']))
                                         <span class="badge bg-secondary">Terkirim</span>
                                         @endif

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

 @endsection