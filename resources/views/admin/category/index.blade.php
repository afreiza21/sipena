@extends('layouts.admin.admin')

@section('title')
    Daftar Kategori
@endsection

@section('content')
    <div class="container-fluid">        
        <h4 class="mT-10 mB-30 c-grey-900">Daftar Kategori</h4>
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
                        <a href="{{ route('admin.category.create') }}" class="btn cur-p btn-success btn-color"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Kategori</a>
                    </div>                  
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th>Kategori</th>
                                <th style="width: 20%;">Aksi</th>                                
                            </tr>
                        </thead>                        
                        <tbody>
                            @forelse ($data as $cat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cat->title_category }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn btn-warning btn-sm c-grey-900"><i
                                            class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('admin.category.delete', $cat->id) }}" class="btn btn-danger btn-sm c-grey-900" onclick="return confirm('Apakah yakin ingin menghapus kategori {{ $cat->title_category }}?');"><i
                                            class="fa fa-trash"></i> Hapus</a>                                    
                                </td>                               
                            </tr>
                            @empty
                            <tr>
                                <th colspan="3" class="text-center">Not Found</th>
                            </tr>
                            @endforelse                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-tambahan')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection