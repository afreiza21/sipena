@extends('layouts.home')
@section('title')
    {{ $data->title }}
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="row g-0 my-5">                
                <div class="col-md-12 my-5">
                    <h2>{{ $data->title }}</h2>
                    <div class="my-5 ratio ratio-16x9">
                        <video controls autoplay>
                            <source src="{{ asset('assets/videos/' . $data->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>                        
                    </div>                    
                    <div class="row">
                        {!! $data->body !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
