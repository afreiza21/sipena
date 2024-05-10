@extends('layouts.home')
@section('title')
    Artikel Edukasi Elinas
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="section-title">
                <h2>Blog</h2>
            </div>
            <div class="row multi-course-crd-list">
                @forelse ($data as $d)
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="crd-img-wrap position-relative">
                            <a href="{{ route('article-detail', $d->slug) }}">
                                <picture>
                                    <img class="crd-img" src="{{ asset('assets/images/blog/' . $d->image) }}" alt="Image Description">
                                </picture>
                            </a>
                        </div>
                        <div class="crd-content">
                            <a href="{{ route('article-detail', $d->slug) }}">
                                <div class="crd-info py-2">
                                </div>

                                <h3 class="card-title my-3">{{ $d->title }}</h3>                                
                                <p class="card-text my-3">{{ AppHelper::instance()->readMore($d->article) }}</p>

                                <div class="crd-bottom d-flex align-items-center justify-content-between">
                                    <div class="crd-profile d-flex align-items-center">
                                        <i class="card-icon fa-solid fa-user fa-lg"></i> <span class="profile-name ms-2">{{ $d->user->name }}</span>
                                    </div>
                                    <div class="crd-profile d-flex align-items-center">
                                        <i class="card-icon fa-solid fa-calendar-days fa-lg"></i> <span class="profile-name ms-2">{{ $d->created_at->format('j F Y') }}</span>
                                    </div>                                    
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 col-lg-12 text-center">
                    <h6>Tidak ada Artikel</h6>
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