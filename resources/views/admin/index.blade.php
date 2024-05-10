@extends('layouts.admin.admin')

@section('title')
    Dashboard Elinas
@endsection
    
@section('content')    
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-12"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h1 class="c-grey-900">Hai {{ Auth::user()->name }}</h1>
                <div class="mT-30">
                    <h4 class="mb-4">Selamat datang kembali di Web Elinas (Edukasi Limbah Nanas) </h4>                    
                </div>
            </div>
        </div>
    </div>    
@endsection