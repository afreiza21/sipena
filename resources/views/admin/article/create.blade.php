@extends('layouts.admin.admin')

@section('title')
    Buat Artikel Baru
@endsection

@section('content')
    <h4 class="mT-10 mB-30 c-grey-900">Buat Artikel Baru</h4>
    <div class="row">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div>
                    <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="inputTitle">Judul Artikel</label>
                            <input type="text" id="inputTitle" class="form-control @error('title') is-invalid @enderror"
                                aria-describedby="titleHelp" placeholder="Masukkan Judul Artikel" autocomplete="off"
                                value="{{ old('title') }}" name="title" required>
                            @error('title')
                                <span id="titleHelp" class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>                                               
                        <div class="mb-3">
                            <label class="form-label" for="inputGambar">Gambar Cover</label>
                            <div class="input-group">
                                <input type="file" id="inputGambar" accept=".jpg,.jpng,.jpeg,.png"
                                    class="form-control  @error('image') is-invalid @enderror" aria-describedby="gambarHelp"
                                    autocomplete="off" name="image" required>
                                <label class="input-group-text">Browse</label>
                            </div>
                            @error('image')
                                <span id="gambarHelp" class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>                          
                        <div class="mb-3">
                            <label class="form-label" for="inputDeskripsi">Isi Artikel</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="inputDeskripsi" name="body" rows="3" required>{{ old('body') }}</textarea>
                            @error('body')
                                <span id="deskripsiHelp" class="invalid-feedback" role="alert">
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('js-tambahan')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('textarea').summernote({
            placeholder: 'Masukkan isi artikel',
            tabsize: 2,
            height: 420,            
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],                
                ['view', ['codeview', 'help']],
            ],
        });
    </script>
@endsection
