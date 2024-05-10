@extends('layouts.admin.admin')

@section('title')
    Daftar Artikel
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mT-10 mB-30 c-grey-900">Daftar Artikel</h4>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="mT-10 mB-30">
                        <a href="{{ route('admin.article.create') }}" class="btn cur-p btn-success btn-color"><i
                                class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Article</a>
                    </div>
                    <div class="table-responsive-md">
                        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">No</th>
                                    <th style="width: 10%;">Gambar</th>
                                    <th>Judul</th>                                    
                                    <th>Penulis</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('assets/images/blog/' . $d->image) }}"
                                                class="img-thumbnail" alt="{{ $d->title }}"></td>
                                        <td>{{ $d->title }}</td>
                                        <td>{{ $d->user->name }}</td>                                        
                                        <td>
                                            <a href="{{ route('admin.article.edit', $d->id) }}"
                                                class="btn btn-warning btn-sm c-grey-900"><i class="fa fa-edit"></i>
                                                Edit</a>
                                            <a href="{{ route('admin.article.delete', $d->id) }}"
                                                class="btn btn-danger btn-sm c-grey-900"
                                                onclick="return confirm('Apakah yakin ingin menghapus artikel {{ $d->title }}?');"><i
                                                    class="fa fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="5" class="text-center">Not Found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-tambahan')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
