@extends('layouts.admin')
@section('title', 'Tambah Form Penilaian Kinerja')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Form Penilaian Kinerja</h1>

    <div class="card-body">
        <form action="{{ route('form_penilaian.store') }}" method="POST">
            @csrf
            <!-- CARD 1 : DATA IDENTITAS -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light fw-bold">
                    Data Identitas
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>

                            @if (in_array(auth()->user()->role, ['admin', 'kabit', 'kanit']))
                            {{-- Admin / Kabit / Kanit --}}
                            <select name="user_id" class="form-control" required>
                                <option value="">-- Pilih Nama --</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            @else
                            {{-- User biasa --}}
                            <input type="text"
                                class="form-control"
                                value="{{ auth()->user()->name }}"
                                readonly>

                            {{-- kirim user_id tersembunyi --}}
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                @foreach ($status as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Unit</label>
                            <select name="unit" class="form-control" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($unit as $unit)
                                <option value="{{ $unit }}">{{ $unit }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach ($jabatan as $jabatan)
                                <option value="{{ $jabatan }}">{{ $jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Penilai</label>
                            <select name="penilai" class="form-control" required>
                                <option value="">-- Pilih Penilai --</option>
                                @foreach ($pejabat as $p)
                                <option value="{{ $p->nama }}">
                                    {{ $p->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Jabatan Penilai</label>
                            <select name="jabatan" class="form-control" required>
                                <option value="">-- Pilih Jabatan Penilai --</option>
                                @foreach ($pejabat as $p)
                                <option value="{{ $p->jabatan }}">
                                    {{ $p->jabatan }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Periode Penilaian</label>
                            <select name="periode" class="form-control" required>
                                <option value="">-- Pilih Periode --</option>
                                @foreach ($periodes as $p)
                                <option value="{{ $p->periode }}">
                                    {{ $p->periode }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label>Tanggal Penilaian</label>
                            <select name="tanggal" class="form-control" required>
                                <option value="">-- Pilih tanggal --</option>
                                @foreach ($periodes as $p)
                                <option value="{{ $p->tanggal }}">
                                    {{ $p->tanggal }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CARD 2 : PENILAIAN KINERJA -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light fw-bold">
                    Form Penilaian Kinerja
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Mempersiapkan kegiatan sesuai uraian tugas</label>
                            <input type="number" name="persiapan_tugas" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Melaksanakan tugas sesuai uraian tugas</label>
                            <input type="number" name="pelaksanaan_tugas" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Supervisor dan Evaluator</label>
                            <input type="number" name="supervisor_evaluator" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Memberikan layanan terhadap peserta didik</label>
                            <input type="number" name="layanan_peserta_didik" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Memberikan layanan terhadap orang tua / rekan</label>
                            <input type="number" name="layanan_orangtua_rekan" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Sholat wajib berjamaah di masjid (LK), awal waktu (PR)</label>
                            <input type="number" name="sholat_berjamaah" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Membaca Al Qur'an dengan tartil minimal 1 juz/hari</label>
                            <input type="number" name="baca_quran_harian" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Memiliki hafalan Al Qur'an (minimal 2 juz)</label>
                            <input type="number" name="hafalan_quran" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Hadir dalam pembinaan pekanan Bina Pribadi Islami</label>
                            <input type="number" name="kehadiran_bpi" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Memiliki kejujuran</label>
                            <input type="number" name="kejujuran" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Tanggung jawab dan ketuntasan tugas</label>
                            <input type="number" name="tanggung_jawab" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Interaksi sosial</label>
                            <input type="number" name="interaksi_sosial" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Selalu hadir</label>
                            <input type="number" name="selalu_hadir" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Datang tepat waktu</label>
                            <input type="number" name="datang_tepat_waktu" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Tertib berseragam</label>
                            <input type="number" name="tertib_berseragam" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Koordinasi kelembagaan</label>
                            <input type="number" name="koordinasi_kelembagaan" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Komitmen kelembagaan</label>
                            <input type="number" name="komitmen_kelembagaan" class="form-control nilai">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Total</label>
                            <input type="number" id="total" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Rata-rata</label>
                            <input type="number" id="rata_rata" class="form-control" readonly>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                        <a href="{{ route('form_penilaian.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nilaiInputs = document.querySelectorAll('.nilai');
        const totalInput = document.getElementById('total');
        const rataRataInput = document.getElementById('rata_rata');

        function hitungNilai() {
            let total = 0;
            let jumlah = 0;

            nilaiInputs.forEach(input => {
                const value = parseFloat(input.value);
                if (!isNaN(value)) {
                    total += value;
                    jumlah++;
                }
            });

            totalInput.value = total;
            rataRataInput.value = jumlah > 0 ? (total / jumlah).toFixed(2) : 0;
        }

        nilaiInputs.forEach(input => {
            input.addEventListener('input', hitungNilai);
        });
    });
</script>

@endsection