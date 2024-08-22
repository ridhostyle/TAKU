@extends('link_straps.linkstraps')

<div class="row w-100">
    <div class="col-md-6 d-flex justify-content-center align-items-center">
        <img src="../assets/pt.jpg" style="max-width: 100%; height: 100vh;">
    </div>
    <div class="col-md-6">
        <div class="d-flex justify-content-center mt-5">
            <img src="../assets/Logo.png" style="width: 100px;">
        </div>
        <div class="d-flex justify-content-center align-content-center mt-5">
            <h2 class="text-center">Cuti Kepegawaian <br> Pengadilan Tinggi Pontianak</h2>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <form class="w-50" action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username"
                        value="{{ old('username') }}">
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-danger">
                    @if ($errors->has('login_error'))
                        <p>{{ $errors->first('login_error') }}</p>
                    @endif
                </div>
                <div class="text-center">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary col-8">Login</button>
                    </div>
                </div>
                <div class="text-center">
                    <div class="mb-3">
                        <a href="/status" class="btn btn-warning col-8"> Cek Status Permohonan</a>
                    </div>
                </div>
                <div class="text-center">
                    <div class="mb-3">
                        <a href="/permohonan" class="btn btn-success col-8"> Buat Permohonan</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
