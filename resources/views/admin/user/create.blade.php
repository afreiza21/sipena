@extends('layouts.admin.admin')

@section('title')
    Tambah User
@endsection

@section('content')
    <h4 class="mT-10 mB-30 c-grey-900">Tambah User Baru</h4>
    <div class="row">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div>
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="inputName">Nama</label>
                            <input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror"
                                aria-describedby="nameHelp" placeholder="Masukkan Nama Lengkap" autocomplete="off"
                                value="{{ old('name') }}" name="name" required>
                            @error('name')
                                <span id="nameHelp" class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>    
                        <div class="mb-3">
                            <label class="form-label" for="inputEmail">Email</label>
                            <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"
                                aria-describedby="emailHelp" placeholder="Masukkan Email" autocomplete="off"
                                value="{{ old('email') }}" name="email" required>
                            @error('email')
                                <span id="emailHelp" class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>     
                        
                        <div class="mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">
                
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                autocomplete="new-password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="role">Pilih Kategori</label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role"
                                aria-describedby="roleHelp" id="role" required>
                                <option value="">-- Pilih --</option>
                                <option value="pembeli">Pembeli</option>
                                <option value="penjual">Penjual</option>
                                <option value="admin">Admin</option>                                                                
                            </select>
                            @error('role')
                                <span id="roleHelp" class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div> 

                        <button type="submit" class="btn btn-primary btn-color">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-tambahan')
    
@endsection

@section('js-tambahan')
    
@endsection
