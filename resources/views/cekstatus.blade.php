<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Halaman Cek No ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .custom-border {
            border-width: 3px;
            border-style: solid;
            border-color: #007bff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h2 class="text-center text-dark mb-3 mt-5">CEK STATUS PERMOHONAN</h2>
    <h5 class="text-center text-dark mb-5 mt-2">MASUKKAN NOMOR ID PERMOHONAN</h5>
    <div class="d-grid gap-1 col-1 mx-auto mt-4">
        <button class="btn btn-warning" type="button">Kembali</button>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <form id="searchForm" style="display: flex; align-items: flex-start;">
            <input type="text" class="form-control" id="searchId" aria-describedby="idHelp"
                placeholder="Masukkan ID" required>
            <button type="submit" class="btn btn-primary">Periksa</button>
        </form>
    </div>
    <div id="statusContainer" class="d-flex justify-content-center mt-5">
        <!-- Status form akan muncul di sini setelah pencarian -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIqK6J3l3n7B1I4H9tL6d9P5Fz/6kU4k5u0A6wJmy9bE4j9hvjk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah form dari submit default

                var searchId = document.getElementById('searchId').value;
                var statusContainer = document.getElementById('statusContainer');

                fetch('{{ route('check.status') }}', {
                        method: 'POST',
                        body: JSON.stringify({
                            id: searchId
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.id) {
                            statusContainer.innerHTML = `
                            <form class="custom-border w-25 p-4">
                                <h2 class="text-center text-dark mb-5 mt-1">STATUS CUTI</h2>
                                <div>
                                    <p><strong>Nama :</strong> ${data.nama}</p>
                                    <p><strong>NIP :</strong> ${data.nip}</p>
                                    <p><strong>Jabatan :</strong> ${data.jabatan}</p>
                                    <p><strong>Mulai Cuti :</strong> ${data.mulai_cuti}</p>
                                    <p><strong>Selesai Cuti :</strong> ${data.selesai_cuti}</p>
                                    <p><strong>Jenis Cuti :</strong> ${data.jenis_cuti}</p>
                                    <p><strong>Alasan Cuti :</strong> ${data.alasan_cuti}</p>
                                    <p><strong>Status :</strong> ${data.status}</p> 
                                </div>
                            </form>
                        `;
                        } else {
                            Swal.fire({
                                title: 'Not Found!',
                                text: 'Permohonan dengan ID ini tidak ditemukan.',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mencari permohonan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        });
    </script>
</body>

</html>
