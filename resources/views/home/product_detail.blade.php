@extends('layouts.home')
@section('title')
    {{ $data->title }}
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-fluid product-img" src="{{ asset('assets/images/products/' . $data->image) }}"
                        alt="{{ $data->title }}">
                </div>
                <div class="col-md-8 product">
                    <div class="badge bg-primary my-3">
                        {{ $data->category->title_category }}
                    </div>
                    <h2>{{ $data->title }}</h2>
                    <div class="product-price my-3">
                        <span>{{ AppHelper::instance()->rupiah($data->harga) }}</span>
                    </div>                    
                    <h4 class="mt-4">Deskripsi</h4>
                    {!! $data->body !!}
                    <h4>Jumlah yang ingin dibeli</h4>
                    <form action="{{ route('add-cart') }}" method="POST">
                        @csrf
                        <input type="number" name="product_id" value="{{ $data->id }}" hidden readonly>
                        <div class="form-group focused my-2">
                        <input class="form-control form-control-alternative" type="number" id="qty"
                                name="qty" min="1" value="1">
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Beli Langsung</button> --}}
                        @guest
                        <a class="btn btn-success" href="{{ route('login') }}">
                            <i class="fa-solid fa-cart-shopping"></i> Tambahkan ke Keranjang
                        </a>
                        @else
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-cart-shopping"></i> Tambahkan ke Keranjang
                        </button>
                        @endguest
                    </form>


                </div>
            </div>

            {{-- <div class="row multi-course-crd-list">
                @forelse ($data as $d)
                <div class="col-md-6 col-lg-3">
                    <div class="course-card">
                        <div class="crd-img-wrap position-relative">
                            <a href="{{ route('article-detail', $d->slug) }}">
                                <picture>
                                    <img class="crd-img" src="{{ asset('assets/images/products/' . $d->image) }}" alt="Image Description">
                                </picture>
                            </a>
                        </div>
                        <div class="crd-content">
                            <a href="{{ route('article-detail', $d->slug) }}">
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
            </div> --}}
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
