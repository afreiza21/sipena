<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $article = Article::limit(3)->get();;
        $cart = $this->count_cart();
        return view('home.index', compact('article', 'cart'));
    }

    public function about()
    {
        $cart = $this->count_cart();
        return view('home.about', compact('cart'));
    }

    public function article()
    {
        $data = Article::all();
        $cart = $this->count_cart();
        return view('home.article', compact('data', 'cart'));
    }

    public function article_detail($slug)
    {
        $data = Article::all()->where('slug', $slug)->first();
        $cart = $this->count_cart();
        return view('home.article_detail', compact('data', 'cart'));
    }

    public function video()
    {
        $data = Video::all();
        $cart = $this->count_cart();
        return view('home.video', compact('data', 'cart'));
    }

    public function video_play($slug)
    {
        $data = Video::all()->where('slug', $slug)->first();
        $cart = $this->count_cart();
        return view('home.video_play', compact('data', 'cart'));
    }

    public function product()
    {
        $data = Product::all();
        $cart = $this->count_cart();
        return view('home.product', compact('data', 'cart'));
    }

    public function product_detail($slug)
    {
        $data = Product::all()->where('slug', $slug)->first();
        $cart = $this->count_cart();
        return view('home.product_detail', compact('data', 'cart'));
    }

    public function add_cart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);        

        if (auth()->check()) {                        
            $data = Cart::where('product_id', $request->product_id)->first();
            if (empty($data)) {
                Cart::create([
                    'product_id' => $request->product_id,
                    'user_id' => auth()->user()->id,
                    'qty' => $request->qty,
                ]);
            } else {
                $data->update([                    
                    'qty' => $data->qty + $request->qty,
                ]);
            }
            return back()->with('success', 'Produk telah ditambahkan ke keranjang belanja');
        } else {
            # jika belum login            
            return redirect()->route('login');
        }
    }

    public function cart()
    {
        $cart = $this->count_cart();
        $data = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        return view('home.cart', compact('data', 'cart'));
    }

    public function delete_cart($id)
    {
        Cart::find($id)->delete();
        return back()->with('success-cart', 'Produk berhasil dihapus dari keranjang');
    }

    private function count_cart()
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->count();
        } else {
            $cart = 0;
        }

        return $cart;
    }

    public function order()
    {
        $cart = $this->count_cart();
        if ($cart > 0) {
            $data = Cart::with('product')->where('user_id', auth()->user()->id)->get();
            return view('home.order', compact('data', 'cart'));
        } else {
            return redirect()->route('product');
        }
    }

    public function add_order(Request $request)
    {
        $no_WA = "6285641200794";
        $sum_tot_Price = 0;

        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'postalcode' => 'required|numeric',
                'address' => 'required',
            ],
            [
                'name.required' => 'Nama lengkap harus diisi',
                'phone.required' => 'Nomor telepon harus diisi',
                'phone.numeric' => 'Nomor telepon harus sesuai format',
                'postalcode.required' => 'Kode pos harus diisi',
                'postalcode.numeric' => 'Kode pos harus sesuai format',
                'address' => 'Nomor telepon harus diisi',
            ]
        );

        if (auth()->check()) {
            $cart = $this->count_cart();

            if ($cart > 0) {
                $data = Cart::with('product')->where('user_id', auth()->user()->id)->get();
            } else {
                return redirect()->route('product');
            }

            $message = "Halo, saya ingin melakukan pesanan sebagai berikut:

Nama: $request->name
No HP: $request->phone
Kode Pos: $request->postalcode
Alamat: $request->address
";

            foreach ($data as $item) {
                $message .= "
Nama Produk: " . $item->product->title . "
Harga: Rp. " . number_format($item->product->harga) . "
Jumlah: $item->qty
";
                $sum_tot_Price += $item->product->harga;
            }

            $message .= "
Total Pembayaran: Rp. " . number_format($sum_tot_Price) . "

Terima kasih";

            $url = "https://api.whatsapp.com/send?phone=" . $no_WA . "&text=" . urlencode($message);

            Cart::with('product')->where('user_id', auth()->user()->id)->delete();
            return Redirect::to($url);
        } else {
            # jika belum login            
            return redirect()->route('login');
        }
    }
}
