@extends('all_layouts.sidebar')

@section('title', 'Verifikasi Permohonan')

@section('content')
    <div class="container-fluid">
        <!-- Page Content -->
        <div class="row pt-2 pb-2 mb-3 m-2">
            <h2>Verifikasi Permohonan</h2>
        </div>
        <div>
            <table border="1" cellpadding="10" cellspacing="0"
                style="margin-top: 20px; border-collapse: collapse; width: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgb(254, 254, 254);">
                <thead>
                    <tr style="background-color: #ffffff; color: #333;">
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">ID</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Nama</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">NIP</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Jabatan</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Mulai Cuti</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Selesai Cuti</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Jenis Cuti</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Alasan cuti</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Status</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permohonan as $d)
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->id }}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->nama }}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->nip }}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->jabatan }}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->mulai_cuti }}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->selesai_cuti }}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->jenis_cuti }}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $d->alasan_cuti }}</td>
                            <td
                                style="padding: 10px; border-bottom: 1px solid #ddd; color:
                                @if ($d->status == 'menunggu') yellow; 
                                @elseif ($d->status == 'terima') green; 
                                @elseif ($d->status == 'tolak') red; 
                                @else black; /* default color */ @endif ">
                                {{ $d->status }}
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                <button type="button" class="btn btn-success btn-sm"
                                    onclick="confirmAccept('{{ $d->id }}')">
                                    <i class="fa-solid fa-check-to-slot"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm"
                                    onclick="handleApproval('{{ $d->id }}', 'verified')">
                                    <i class="fa-solid fa-user-check"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="handleApproval('{{ $d->id }}', 'rejected')">
                                    <i class="fa-solid fa-square-xmark"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <!-- Link SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmAccept(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Permohonan akan diterima.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, terima!'
            }).then((result) => {
                if (result.isConfirmed) {
                    handleApproval(id, 'accepted');
                }
            });
        }

        function handleApproval(id, status) {
            let title, text, icon;

            if (status === 'accepted') {
                title = 'Berhasil!';
                text = 'Permohonan telah diterima.';
                icon = 'success';
            } else if (status === 'rejected') {
                title = 'Ditolak!';
                text = 'Permohonan telah ditolak.';
                icon = 'error';
            } else if (status === 'verified') {
                title = 'Terverifikasi!';
                text = 'Permohonan telah diverifikasi.';
                icon = 'info';
            }

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                confirmButtonText: 'OK'
            });

            $.ajax({
                url: '/update-status/' + id, // URL endpoint yang sesuai
                method: 'POST',
                data: {
                    status: status,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Lakukan sesuatu setelah berhasil mengirim data ke server
                    // Misalnya, refresh halaman atau update tabel
                }
            });
        }
    </script>
@endsection
