@extends('layouts.admin.admin')

@section('title')
    Ubah Kategori {{ $data->title_category }}
@endsection

@section('content')
    <h4 class="mT-10 mB-30 c-grey-900">Ubah Kategori {{ $data->title_category }}</h4>
    <div class="row">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div class="mT-30">
                    <form action="{{ route('admin.category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <div class="mb-3">
                            <label class="form-label" for="inputKategori">Nama Kategori</label>
                            <input type="text" class="form-control @error('title_category') is-invalid @enderror" id="inputKategori" aria-describedby="kategoriHelp"
                                placeholder="Masukkan Nama Kategori" autocomplete="off" value="{{ $data->title_category }}" name="title_category" required>                            
                            @error('title_category')
                            <span id="kategoriHelp" class="invalid-feedback" role="alert">
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
