@extends('layouts.home')
@section('title')
    Video Edukasi Elinas
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="section-title">
                <h2>Video Edukasi</h2>
            </div>
            <div class="row multi-course-crd-list">                
                @forelse ($data as $d)
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="crd-img-wrap position-relative">
                            <button class="position-absolute top-50 start-50 translate-middle" type="button">
                                <i class="play-icon fa-solid fa-circle-play fa-8x"></i>
                            </button><a href="{{ route('video-play', $d->slug) }}">
                                <picture>
                                    <img class="crd-img" src="{{ asset('assets/images/education/' . $d->image) }}" alt="{{ $d->title }}">
                                </picture>
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('video-play', $d->slug) }}">
                                <div class="crd-info py-2">
                                </div>
                                <h3 class="card-title my-3">{{ $d->title }}</h3>                                                                
                            </a>
                        </div>
                    </div>
                </div>                
                @empty
                <div class="col-md-12 col-lg-12 text-center">
                    <h6>Tidak ada video</h6>
                </div>
                @endforelse
            </div>
            {{-- <div class="row my-5">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    </ul>
                </nav>
            </div> --}}
        </div>
    </main>
@endsection