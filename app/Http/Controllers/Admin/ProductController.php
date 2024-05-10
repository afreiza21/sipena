<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Product::all();
        return view('admin.product.index', compact('data'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|unique:products',
                'category_id' => 'required|numeric',
                'harga' => 'required|numeric',
                'body' => 'required',
                'image' => 'required|image|mimes:jpg,jpng,jpeg,png'
            ],
            [
                'title.required' => 'Nama produk harus diisi',
                'title.unique' => 'Nama produk sudah ada',
                'category_id.required' => 'Kategori harus dipilih',
                'category_id.numeric' => 'Kategori harus dipilih',
                'harga.required' => 'Harga harus diisi',
                'harga.numeric' => 'Harga harus berupa angka',
                'body.required' => 'Deskripsi produk harus diisi',
                'image.required' => 'Gambar produk harus diisi',
                'image.image' => 'Gambar produk harus berupa gambar',
                'image.mimes' => 'Gambar produk harus bertipe jpg,jpng,jpeg,png',
            ]
        );

        $image_file = time() . '.' . $request->image->extension();
        Product::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug'  => str_replace(' ', '-', $request->title),
            'harga' => $request->harga,
            'body'  => $request->body,
            'image' => $image_file
        ]);
        $request->image->move(public_path('assets/images/products'), $image_file);

        return redirect()->route('admin.product')->with('success', 'Produk baru telah ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::all();
        $data = Product::findorfail($id);
        return view('admin.product.edit', compact('data', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = Product::find($id);

        if (empty($request->image)) {
            $request->validate(
                [
                    'title' => 'required',
                    'category_id' => 'required|numeric',
                    'harga' => 'required|numeric',
                    'body' => 'required',
                ],
                [
                    'title.required' => 'Nama produk harus diisi',
                    'category_id.required' => 'Kategori harus dipilih',
                    'category_id.numeric' => 'Kategori harus dipilih',
                    'harga.required' => 'Harga harus diisi',
                    'harga.numeric' => 'Harga harus berupa angka',
                    'body.required' => 'Deskripsi produk harus diisi',
                ]
            );
            if ($data->title != $request->title) {
                $request->validate(
                    [
                        'title' => 'unique:products',
                    ],
                    [
                        'title.unique' => 'Nama produk sudah ada',
                    ]
                );
            }
            $data->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug'  => str_replace(' ', '-', $request->title),
                'harga' => $request->harga,
                'body'  => $request->body,
            ]);
        } else {
            if ($data->title != $request->title) {
                $request->validate(
                    [
                        'title' => 'unique:products',
                    ],
                    [
                        'title.unique' => 'Nama produk sudah ada',
                    ]
                );
            }
            $request->validate(
                [
                    'title' => 'required',
                    'category_id' => 'required|numeric',
                    'harga' => 'required|numeric',
                    'body' => 'required',
                    'image' => 'required|image|mimes:jpg,jpng,jpeg,png'
                ],
                [
                    'title.required' => 'Nama produk harus diisi',
                    'category_id.required' => 'Kategori harus dipilih',
                    'category_id.numeric' => 'Kategori harus dipilih',
                    'harga.required' => 'Harga harus diisi',
                    'harga.numeric' => 'Harga harus berupa angka',
                    'body.required' => 'Deskripsi produk harus diisi',
                    'image.required' => 'Gambar produk harus diisi',
                    'image.image' => 'Gambar produk harus berupa gambar',
                    'image.mimes' => 'Gambar produk harus bertipe jpg,jpng,jpeg,png',
                ]
            );
            $image_file = time() . '.' . $request->image->extension();
            $old_image = public_path('assets/images/products/' . $data->image);
            if (file_exists($old_image) && is_file($old_image)) {
                unlink($old_image);
            }
            $data->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug'  => str_replace(' ', '-', $request->title),
                'harga' => $request->harga,
                'body'  => $request->body,
                'image' => $image_file,
            ]);
            $request->image->move(public_path('assets/images/products'), $image_file);
        }

        return redirect()->route('admin.product')->with('success', 'Data produk telah diubah');
    }

    public function destroy($id)
    {
        $data = Product::find($id);
        $old_image = public_path('assets/images/products/' . $data->image);
        if (file_exists($old_image) && is_file($old_image)) {
            unlink($old_image);
        }
        $data->delete();
        return redirect()->route('admin.product')->with('success', 'Data produk telah dihapus');
    }
}
