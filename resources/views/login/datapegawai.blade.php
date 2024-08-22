@extends('all_layouts.sidebar')

@section('title', 'Data Cuti Pegawai')

@section('content')
    <div class="container-fluid">
        <div class="row pt-2 pb-2 mb-3 m-2">
            <h2>Data Cuti Pegawai</h2>
        </div>

        <div class="mb-3">
            <a href="#" class="btn btn-primary" id="tambahPegawaiBtn">
                <i class="fa-solid fa-plus"></i> Tambah Pegawai Baru
            </a>
        </div>

        <div>
            <table class="table table-striped bg-white">
                <thead class="text-center">
                    <th>No</th>
                    <th>NAMA</th>
                    <th>NIP</th>
                    <th>JABATAN</th>
                    <th>TOTAL CUTI DIAMBIL</th>
                    <th>SISA CUTI</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <th>1</th>
                        <td>Ridho Setiawan</td>
                        <td>3202116042</td>
                        <td>Mahasiswa</td>
                        <td>8</td>
                        <td>4 hari</td>
                        <td>
                            <span class="status-label text-success">AKTIF</span>
                        </td>
                        <td>
                            <button class="btn btn-md btn-primary edit-btn" data-nama="Ridho Setiawan" data-nip="3202116042"
                                data-jabatan="Mahasiswa" data-total-cuti="8" data-sisa-cuti="4 hari" data-status="AKTIF">
                                <i class="fa-solid fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                    <!-- Tambahkan baris data pegawai di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script untuk menampilkan form tambah pegawai baru
            document.getElementById('tambahPegawaiBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Form Tambah Pegawai Baru',
                    html: `
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="new-nama">Nama :</label>
                                <input id="new-nama" class="form-control" type="text" placeholder="Nama Pegawai">
                            </div>
                            <div class="form-group">
                                <label for="new-nip">NIP :</label>
                                <input id="new-nip" class="form-control" type="text" placeholder="NIP Pegawai">
                            </div>
                            <div class="form-group">
                                <label for="new-jabatan">Jabatan :</label>
                                <input id="new-jabatan" class="form-control" type="text" placeholder="Jabatan Pegawai">
                            </div>
                            <div class="form-group">
                                <label for="new-total-cuti">Total Cuti Diambil :</label>
                                <input id="new-total-cuti" class="form-control" type="number" placeholder="Total Cuti Diambil">
                            </div>
                            <div class="form-group">
                                <label for="new-sisa-cuti">Sisa Cuti :</label>
                                <input id="new-sisa-cuti" class="form-control" type="text" placeholder="Sisa Cuti">
                            </div>
                            <div class="form-group">
                                <label for="new-status">Status :</label>
                                <select id="new-status" class="form-control">
                                    <option value="AKTIF">Aktif</option>
                                    <option value="NONAKTIF">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    `,
                    customClass: {
                        content: 'form-container'
                    },
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const nama = Swal.getPopup().querySelector('#new-nama').value;
                        const nip = Swal.getPopup().querySelector('#new-nip').value;
                        const jabatan = Swal.getPopup().querySelector('#new-jabatan').value;
                        const totalCuti = Swal.getPopup().querySelector('#new-total-cuti')
                            .value;
                        const sisaCuti = Swal.getPopup().querySelector('#new-sisa-cuti').value;
                        const status = Swal.getPopup().querySelector('#new-status').value;

                        if (!nama || !nip || !jabatan || !totalCuti || !sisaCuti || !status) {
                            Swal.showValidationMessage(`Semua Data harus diisi`);
                        }

                        return {
                            nama,
                            nip,
                            jabatan,
                            totalCuti,
                            sisaCuti,
                            status
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Konfirmasi Data Pegawai',
                            html: `
                                <p><strong>Nama:</strong> ${result.value.nama}</p>
                                <p><strong>NIP:</strong> ${result.value.nip}</p>
                                <p><strong>Jabatan:</strong> ${result.value.jabatan}</p>
                                <p><strong>Total Cuti Diambil:</strong> ${result.value.totalCuti}</p>
                                <p><strong>Sisa Cuti:</strong> ${result.value.sisaCuti}</p>
                                <p><strong>Status:</strong> <span class="${result.value.status === 'AKTIF' ? 'text-success' : 'text-danger'}">${result.value.status}</span></p>
                            `,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Simpan',
                            cancelButtonText: 'Batal'
                        }).then((confirmResult) => {
                            if (confirmResult.isConfirmed) {
                                fetch('{{ route('datacutipegawai.store') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]')
                                                .getAttribute('content')
                                        },
                                        body: JSON.stringify(result.value)
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        Swal.fire({
                                            title: 'Data Pegawai Baru',
                                            html: `
                                            <p><strong>Nama:</strong> ${data.data.nama}</p>
                                            <p><strong>NIP:</strong> ${data.data.nip}</p>
                                            <p><strong>Jabatan:</strong> ${data.data.jabatan}</p>
                                            <p><strong>Total Cuti Diambil:</strong> ${data.data.total_cuti_diambil}</p>
                                            <p><strong>Sisa Cuti:</strong> ${data.data.sisa_cuti}</p>
                                            <p><strong>Status:</strong> <span class="${data.data.status === 'AKTIF' ? 'text-success' : 'text-danger'}">${data.data.status}</span></p>
                                        `,
                                            icon: 'success'
                                        });
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            title: 'Terjadi Kesalahan',
                                            text: 'Gagal menambahkan data pegawai.',
                                            icon: 'error'
                                        });
                                    });
                            } else if (confirmResult.isDismissed) {
                                Swal.fire({
                                    title: 'Dibatalkan',
                                    text: 'Form tambah pegawai dibatalkan.',
                                    icon: 'info'
                                });
                            }
                        });
                    } else if (result.isDismissed) {
                        Swal.fire({
                            title: 'Dibatalkan',
                            text: 'Form tambah pegawai dibatalkan.',
                            icon: 'info'
                        });
                    }
                });
            });

            // Script untuk edit data pegawai
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const nama = this.getAttribute('data-nama');
                    const nip = this.getAttribute('data-nip');
                    const jabatan = this.getAttribute('data-jabatan');
                    const totalCuti = this.getAttribute('data-total-cuti');
                    const sisaCuti = this.getAttribute('data-sisa-cuti');
                    const status = this.getAttribute('data-status');

                    Swal.fire({
                        title: 'Form Edit Pegawai',
                        html: `
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit-nama">Nama :</label>
                                    <input id="edit-nama" class="form-control" type="text" value="${nama}" placeholder="Nama Pegawai">
                                </div>
                                <div class="form-group">
                                    <label for="edit-nip">NIP :</label>
                                    <input id="edit-nip" class="form-control" type="text" value="${nip}" placeholder="NIP Pegawai">
                                </div>
                                <div class="form-group">
                                    <label for="edit-jabatan">Jabatan :</label>
                                    <input id="edit-jabatan" class="form-control" type="text" value="${jabatan}" placeholder="Jabatan Pegawai">
                                </div>
                                <div class="form-group">
                                    <label for="edit-total-cuti">Total Cuti Diambil :</label>
                                    <input id="edit-total-cuti" class="form-control" type="number" value="${totalCuti}" placeholder="Total Cuti Diambil">
                                </div>
                                <div class="form-group">
                                    <label for="edit-sisa-cuti">Sisa Cuti :</label>
                                    <input id="edit-sisa-cuti" class="form-control" type="text" value="${sisaCuti}" placeholder="Sisa Cuti">
                                </div>
                                <div class="form-group">
                                    <label for="edit-status">Status :</label>
                                    <select id="edit-status" class="form-control">
                                        <option value="AKTIF" ${status === 'AKTIF' ? 'selected' : ''}>Aktif</option>
                                        <option value="NONAKTIF" ${status === 'NONAKTIF' ? 'selected' : ''}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        `,
                        customClass: {
                            content: 'form-container'
                        },
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        cancelButtonText: 'Batal',
                        preConfirm: () => {
                            const nama = Swal.getPopup().querySelector('#edit-nama')
                                .value;
                            const nip = Swal.getPopup().querySelector('#edit-nip')
                                .value;
                            const jabatan = Swal.getPopup().querySelector(
                                '#edit-jabatan').value;
                            const totalCuti = Swal.getPopup().querySelector(
                                '#edit-total-cuti').value;
                            const sisaCuti = Swal.getPopup().querySelector(
                                '#edit-sisa-cuti').value;
                            const status = Swal.getPopup().querySelector('#edit-status')
                                .value;

                            if (!nama || !nip || !jabatan || !totalCuti || !sisaCuti ||
                                !status) {
                                Swal.showValidationMessage(`Semua Data harus diisi`);
                            }

                            return {
                                nama,
                                nip,
                                jabatan,
                                totalCuti,
                                sisaCuti,
                                status
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Data Pegawai Terbaru',
                                html: `
                                    <p><strong>Nama:</strong> ${result.value.nama}</p>
                                    <p><strong>NIP:</strong> ${result.value.nip}</p>
                                    <p><strong>Jabatan:</strong> ${result.value.jabatan}</p>
                                    <p><strong>Total Cuti Diambil:</strong> ${result.value.totalCuti}</p>
                                    <p><strong>Sisa Cuti:</strong> ${result.value.sisaCuti}</p>
                                    <p><strong>Status:</strong> <span class="${result.value.status === 'AKTIF' ? 'text-success' : 'text-danger'}">${result.value.status}</span></p>
                                `,
                                icon: 'success'
                            });
                        } else if (result.isDismissed) {
                            Swal.fire({
                                title: 'Dibatalkan',
                                text: 'Form edit pegawai dibatalkan.',
                                icon: 'info'
                            });
                        }
                    });
                });
            });
        });
    </script>

    <style>
        .form-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .form-group label {
            margin-right: 10px;
            text-align: right;
            flex: 1;
        }

        .form-group input,
        .form-group select {
            flex: 2;
        }

        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
        }
    </style>
@endsection
