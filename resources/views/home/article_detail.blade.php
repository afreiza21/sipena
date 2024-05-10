@extends('layouts.home')
@section('title')
    {{ $data->title }}
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="row g-0 my-5">
                <div class="col-md-12">
                    <img class="blog-img img-fluid" src="{{ asset('assets/images/blog/' . $data->image) }}" alt="">
                </div>
                <div class="col-md-12 my-5">
                    <h2>{{ $data->title }}</h2>
                    <div class="row">
                        <div class="blog-meta">
                            <span><i class="fa-solid fa-user fa-lg"></i> {{ $data->user->name }}</span>
                            <span><i class="fa-solid fa-calendar-days fa-lg"></i>
                                {{ $data->created_at->format('j F Y') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        {!! $data->article !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
