@extends('all_layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Content -->
        <div class="row pt-1 pb-1 mb-1 m-1 text-white">
            <h2>Welcome to Dashboard</h2>
        </div>
        <div class="position-relative">
            @include('all_layouts.cobagrafik')
        </div>
        <br>
        <div class="rounded-4 p-3 mb-4 bg-white">
            <h3>Shortcut</h3>
            <div class="mt-0">
                <button class="btn btn-outline-warning text-dark">Yang Mengajukan Permohonan</button>
                <button class="btn btn-outline-success text-dark ms-2">Data Cuti Pegawai</button>
            </div>
        </div>
        <div class="row border mt-4 w-50 p-3 m-0 bg-white">
            <h3>Syarat Cuti Tahunan</h3>
            <h5>
                <br>
                Aturan cuti ini diberikan untuk PNS yang setidaknya sudah bekerja sekurang-kurangnya 1 tahun secara terus
                menerus. Dengan lamanya masa cuti adalah 12 hari kerja.

                Untuk mengajukan cuti tahunan, kamu harus mengajukannya secara tertulis kepada pejabat yang berwenang
                memberi cuti. Cuti ini tidak bisa dipecah-pecah hingga jangka waktu yang kurang dari 3 hari kerja.
            </h5>
        </div>
    </div>
@endsection
