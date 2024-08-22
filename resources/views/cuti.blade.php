@extends('all_layouts.sidebar')
@extends('link_straps.linkstraps')

@section('title', 'Data Cuti Pegawai')

@section('content')
    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tambahkan Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tambahkan Bootstrap JS dan jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <h1>Daftar Data Cuti Pegawai</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Button untuk membuka modal tambah data -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">
        Tambah Data Cuti Baru
    </button>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataModalLabel">Tambah Data Cuti Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addDataForm" action="{{ route('cuti.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama') }}">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                value="{{ old('nip') }}">
                            @error('nip')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan:</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                value="{{ old('jabatan') }}">
                            @error('jabatan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_cuti">Total Cuti:</label>
                            <input type="number" class="form-control" id="total_cuti" name="total_cuti"
                                value="{{ old('total_cuti') }}">
                            @error('total_cuti')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sisa_cuti">Sisa Cuti:</label>
                            <input type="text" class="form-control" id="sisa_cuti" name="sisa_cuti"
                                value="{{ old('sisa_cuti') }}">
                            @error('sisa_cuti')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" class="form-control">
                                <option value="AKTIF" {{ old('status') == 'AKTIF' ? 'selected' : '' }}>Aktif</option>
                                <option value="NONAKTIF" {{ old('status') == 'NONAKTIF' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </select>
                            @error('status')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="button" id="submitButton" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataModalLabel">Edit Data Cuti Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editDataForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_nama">Nama:</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama"
                                value="{{ old('nama') }}">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="edit_nip">NIP:</label>
                            <input type="text" class="form-control" id="edit_nip" name="nip"
                                value="{{ old('nip') }}">
                            @error('nip')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="edit_jabatan">Jabatan:</label>
                            <input type="text" class="form-control" id="edit_jabatan" name="jabatan"
                                value="{{ old('jabatan') }}">
                            @error('jabatan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="edit_total_cuti">Total Cuti:</label>
                            <input type="number" class="form-control" id="edit_total_cuti" name="total_cuti"
                                value="{{ old('total_cuti') }}">
                            @error('total_cuti')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="edit_sisa_cuti">Sisa Cuti:</label>
                            <input type="text" class="form-control" id="edit_sisa_cuti" name="sisa_cuti"
                                value="{{ old('sisa_cuti') }}">
                            @error('sisa_cuti')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="edit_status">Status:</label><br>
                            <input type="radio" id="edit_status_aktif" name="status" value="AKTIF"
                                {{ old('status') == 'AKTIF' ? 'checked' : '' }}>
                            <label for="edit_status_aktif">Aktif</label><br>
                            <input type="radio" id="edit_status_nonaktif" name="status" value="NONAKTIF"
                                {{ old('status') == 'NONAKTIF' ? 'checked' : '' }}>
                            <label for="edit_status_nonaktif">Nonaktif</label><br>
                            @error('status')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="button" id="editSubmitButton" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <table border="1" cellpadding="10" cellspacing="0"
        style="margin-top: 20px; border-collapse: collapse; width: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgb(255, 255, 255);">
        <thead>
            <tr style="background-color: #f4f4f4; color: #333;">
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">ID</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Nama</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">NIP</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Jabatan</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Total Cuti</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Sisa Cuti</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Status</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dacus as $d)
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->id }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->nama }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->nip }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->jabatan }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->total_cuti }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->sisa_cuti }}</td>
                    <td
                        style="padding: 10px; border-bottom: 1px solid #ddd; color: {{ $d->status == 'AKTIF' ? 'green' : 'red' }};">
                        {{ $d->status }}
                    </td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#editDataModal" data-id="{{ $d->id }}" data-nama="{{ $d->nama }}"
                            data-nip="{{ $d->nip }}" data-jabatan="{{ $d->jabatan }}"
                            data-total-cuti="{{ $d->total_cuti }}" data-sisa-cuti="{{ $d->sisa_cuti }}"
                            data-status="{{ $d->status }}">
                            Edit
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        // Script untuk menampilkan data di modal edit
        $('#editDataModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var id = button.data('id');
            var nama = button.data('nama');
            var nip = button.data('nip');
            var jabatan = button.data('jabatan');
            var totalCuti = button.data('total-cuti');
            var sisaCuti = button.data('sisa-cuti');
            var status = button.data('status');

            var modal = $(this);
            modal.find('.modal-body #edit_nama').val(nama);
            modal.find('.modal-body #edit_nip').val(nip);
            modal.find('.modal-body #edit_jabatan').val(jabatan);
            modal.find('.modal-body #edit_total_cuti').val(totalCuti);
            modal.find('.modal-body #edit_sisa_cuti').val(sisaCuti);
            modal.find('.modal-body input[name="status"][value="' + status + '"]').prop('checked', true);

            // Setel action URL untuk form edit sesuai dengan ID
            modal.find('#editDataForm').attr('action', '/cuti/' + id);
        });

        // Script untuk menampilkan SweetAlert2 saat submit form tambah data
        $('#submitButton').click(function(e) {
            e.preventDefault(); // Mencegah form submit secara default

            var form = $('#addDataForm');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menambahkan data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika konfirmasi
                }
            });
        });

        // Script untuk menampilkan SweetAlert2 saat submit form edit data
        $('#editSubmitButton').click(function(e) {
            e.preventDefault(); // Mencegah form submit secara default

            var form = $('#editDataForm');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menyimpan perubahan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika konfirmasi
                }
            });
        });
    </script>
@endsection
