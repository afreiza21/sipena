@extends('layouts.home')
@section('title')
    Formulir Pemesanan
@endsection

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="section-title">
                <h2>Formulir Pemesanan</h2>
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
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sum_tot_Price = 0; ?>
                            @forelse ($data as $item)
                            <?php $sum_tot_Price += ($item->product->harga * $item->qty); ?>
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->product->title }}</td>
                                    <td>Rp. {{ number_format($item->product->harga) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp. {{ number_format($sum_tot_Price) }}</td>
                                </tr>                                
                            @empty
                                <tr>
                                    <th colspan="5" class="text-center">Tidak ada barang</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="container-fluid">
                    <h2 class="mb-4">Identitas Pembeli</h2>
                    <form action="{{ route('add-order') }}" method="post">
                        @csrf
                        <input type="hidden" name="total" value="19000">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="name"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon</label>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                                        <input type="tel" class="form-control" name="phone"
                                            placeholder="628xxxxxxxxxx" pattern="628[0-9]{10,11}" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postalcode">Kode Pos</label>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-mail-bulk"></i></span>
                                        <input type="number" class="form-control" name="postalcode" autocomplete="off"
                                            required>
                                        @error('postalcode')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="address">Alamat Lengkap</label>
                                <textarea class="form-control form-control-alternative" name="address" id="address" cols="30" rows="10"
                                    required=""></textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse py-4">
                            <button type="submit" class="btn btn-success col-md-2">Beli</button>
                            <h2 class="px-4">Total: Rp. {{ number_format($sum_tot_Price) }}</h2>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
