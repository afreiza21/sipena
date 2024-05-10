@extends('layouts.home')
@section('title')
    Keranjang
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="section-title">
                <h2>Keranjang</h2>
            </div>
            @if ($message = Session::get('success-cart'))
            <div class="container my-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}                    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="card p-3 rounded-20 shadow-sm mt-2">                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sum_tot_Price = 0; ?>
                            @forelse ($data as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->product->title }}</td>
                                    <td>Rp. {{ number_format($item->product->harga) }}</td>
                                    <td>{{ $item->qty }}</td> 
                                    <td>
                                        <a href="{{ route('cart-delete', $item->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah yakin ingin menghapus {{ $item->product->title }}?');"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php $sum_tot_Price += ($item->product->harga * $item->qty); ?>
                            @empty
                                <tr>
                                    <th colspan="5" class="text-center">Tidak ada barang</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <div class="cart-detail">
                        <p>Total Harga : Rp. {{ number_format($sum_tot_Price) }}</p>
                        <p>Total Produk : {{ count($data) }} Qty</p>
                    </div>                    
                </div>
                <a href="{{ route('order')}}" class="btn btn-secondary btn-success">Beli</a>
            </div>
        </div>
    </main>
@endsection