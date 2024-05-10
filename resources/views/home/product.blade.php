@extends('layouts.home')
@section('title')
    Produk
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="section-title">
                <h2>Produk</h2>
            </div>
            <div class="row multi-course-crd-list">
                @forelse ($data as $d)
                <div class="col-md-6 col-lg-3">
                    <div class="course-card">
                        <div class="crd-img-wrap position-relative">
                            <a href="{{ route('product-detail', $d->slug) }}">
                                <picture>
                                    <img class="crd-img" src="{{ asset('assets/images/products/' . $d->image) }}" alt="Image Description">
                                </picture>
                            </a>
                        </div>
                        <div class="crd-content">
                            <a href="{{ route('product-detail', $d->slug) }}">
                                <div class="crd-info py-2">
                                </div>

                                <h5 class="card-title my-3">{{ $d->title }}</h5>                                
                                <p class="card-text my-3">{{ AppHelper::instance()->rupiah($d->harga) }}</p>                                                                
                                <div class="badge bg-primary mt-3">
                                    {{ $d->category->title_category }}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 col-lg-12 text-center">
                    <h6>Tidak ada produk</h6>
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