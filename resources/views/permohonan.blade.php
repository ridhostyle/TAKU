<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Meta tag untuk CSRF token -->
    <title>Form Permohonan Cuti Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .custom-form {
            border: 2px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            background: #f8f9fa;
        }

        .custom-form .dropdown-menu {
            border-radius: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success navbar-custom">
        <div class="container-fluid justify-content-center">
            <img src="../assets/Logo.png" style="width: 50px;">
        </div>
    </nav>
    <h4 class="text-center text-dark mb-4 mt-3">FORM PERMOHONAN CUTI PEGAWAI</h4>
    <div class="d-flex justify-content-center mt-3">
        <form class="custom-form w-50" id="cutiForm" action="{{ route('form.permohonan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">NAMA :</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP :</label>
                <input type="text" class="form-control" id="nip" name="nip" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">JABATAN :</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
            </div>
            <div class="mb-3">
                <label for="mulai_cuti" class="form-label">MULAI CUTI :</label>
                <input type="date" class="form-control" id="mulai_cuti" name="mulai_cuti" required>
            </div>
            <div class="mb-3">
                <label for="selesai_cuti" class="form-label">SELESAI CUTI :</label>
                <input type="date" class="form-control" id="selesai_cuti" name="selesai_cuti" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Cuti :</label>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" data-value="Cuti Tahunan">Cuti Tahunan</a></li>
                        <li><a class="dropdown-item" href="#" data-value="Sakit">Sakit</a></li>
                    </ul>
                </div>
                <input type="hidden" id="jenis_cuti" name="jenis_cuti" required>
            </div>
            <div class="mb-3">
                <label for="alasan_cuti" class="form-label">ALASAN CUTI :</label>
                <input type="text" class="form-control" id="alasan_cuti" name="alasan_cuti" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('cutiForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah form dari submit default

                var form = e.target;
                var formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.id) {
                            Swal.fire({
                                title: 'Dikirim!',
                                text: `Permohonan Anda telah dikirim dengan ID: ${data.id}`,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Tidak ada ID yang dikirim dalam respon.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengirim permohonan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });

            // Update dropdown button text when an option is selected
            document.querySelectorAll('.dropdown-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    var selectedText = this.textContent;
                    document.getElementById('dropdownMenuButton').textContent = selectedText;
                    document.getElementById('jenis_cuti').value = this.getAttribute('data-value');
                });
            });
        });
    </script>
</body>

</html>
