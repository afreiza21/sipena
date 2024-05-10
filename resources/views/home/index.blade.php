@extends('layouts.home')
@section('title')
    Elinas - Edukasi Limbah Nanas
@endsection

@section('content')
    <header class="masthead">
        <div class="container">
            <h1 class="masthead-heading text-uppercase">Edukasi Limbah Nanas (ELINAS)</h1>
            <div class="masthead-subheading">Edukasi pengolahan limbah kulit nanas menjadi barang yang memiliki nilai jual
            </div>
            <a class="btn btn-light btn-xl text-uppercase" href="">Selengkapnya</a>
        </div>
    </header>
    <main class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex align-items-center">
                    <h1>Mengapa Pengolahan Limbah Nanas</h1>
                </div>
                @forelse ($article as $a)
                <div class="col-md-3 p-3">
                    <h3>{{ $a->title }}</h3>
                    <p>{{ AppHelper::instance()->readMore($a->article) }}</p>
                    <a class="read-more" href="{{ route('article-detail', $a->slug) }}">Selengkapnya &#8594;</a>
                </div>
                @empty
                @endforelse                
            </div>
        </div>
        <div class="my-5">
            <div class="row g-0 my-5">
                <div class="col-md-5">
                    <img class="img-fluid" src="assets/images/img-cover1.png" alt="">
                </div>
                <div class="col-md-7 p-5 d-flex align-items-center">
                    <div>
                        <h4 class="category">Video Edukasi</h4>
                        <h3>Edukasi Limbah Nanas : Pembuatan Pupuk POC</h3>
                        <p>Penggunaan pupuk sangat penting bagi kesehatan dan pertumbuhan tanaman. Pupuk anorganik digunakan
                            dalam jangka waktu yang lama dan dalam jumlah yang tinggi, maka akan menyebabkan kerusakan pada
                            lingkungan, misalnya tanah menjadi lebih keras dan mikroorganisme sebagai unsur yang ikut
                            mempengaruhi jumlah hara pada tanaman menjadi berkurang.</p>
                        <a class="read-more" href="{{ route('video') }}">Selengkapnya &#8594;</a>
                    </div>
                </div>
            </div>
            <div class="row g-0 my-5">
                <div class="col-md-7 p-5 d-flex align-items-center">
                    <div>
                        <h4 class="category">Inovasi</h4>
                        <h3>Pengolahan limbah kulit nanas</h3>
                        <p>Nanas merupakan buah yang banyak diolah di desa siwarak, sayangnya menyisakan limbah yaitu kulit
                            nanas. Limbah kulit nanas ini kurang dimanfaatkan bahkan dibuang begitu saja tanpa adanya
                            pemanfaatan limbah tersebut. Dengan innovasi yang kami berikan limbah kulit nanas dimanfaatkan
                            sebagai pembuatan sabun cuci piring, cairan pembersih lantai, pengharum ruangan dan pupuk
                            organik.</p>
                        <a class="read-more" href="{{ route('article') }}">Selengkapnya &#8594;</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <img class="img-fluid" src="assets/images/img-cover2.png" alt="">
                </div>
            </div>
        </div>

    </main>
@endsection
