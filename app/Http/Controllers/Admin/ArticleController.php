<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Article::all();
        return view('admin.article.index', compact('data'));
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|unique:articles',
                'body' => 'required',
                'image' => 'required|image|mimes:jpg,jpng,jpeg,png'
            ],
            [
                'title.required' => 'Judul artikel harus diisi',
                'title.unique' => 'Judul artikel sudah ada',
                'body.required' => 'Isi artikel harus diisi',
                'image.required' => 'Gambar cover harus diisi',
                'image.image' => 'Gambar cover harus berupa gambar',
                'image.mimes' => 'Gambar cover harus bertipe jpg,jpng,jpeg,png',
            ]
        );

        $image_file = 'image_' . time() . '.' . $request->image->extension();
        Article::create([
            'title' => $request->title,
            'slug'  => str_replace(' ', '-', $request->title),
            'article'  => $request->body,
            'user_id' => auth()->user()->id,
            'image' => $image_file
        ]);
        $request->image->move(public_path('assets/images/blog'), $image_file);

        return redirect()->route('admin.article')->with('success', 'Artikel baru telah ditambahkan');
    }

    public function edit($id)
    {
        $data = Article::findorfail($id);
        return view('admin.article.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Article::find($id);

        if (empty($request->image)) {
            $request->validate(
                [
                    'title' => 'required',
                    'body' => 'required',
                ],
                [
                    'title.required' => 'Judul artikel harus diisi',
                    'body.required' => 'Isi artikel harus diisi',
                ]
            );
            if ($data->title != $request->title) {
                $request->validate(
                    [
                        'title' => 'unique:articles',
                    ],
                    [
                        'title.unique' => 'Judul artikel sudah ada',
                    ]
                );
            }
            $data->update([
                'title' => $request->title,
                'slug'  => str_replace(' ', '-', $request->title),
                'article'  => $request->body,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            if ($data->title != $request->title) {
                $request->validate(
                    [
                        'title' => 'unique:articles',
                    ],
                    [
                        'title.unique' => 'Judul artikel sudah ada',
                    ]
                );
            }
            $request->validate(
                [
                    'title' => 'required',
                    'body' => 'required',
                ],
                [
                    'title.required' => 'Judul artikel harus diisi',
                    'body.required' => 'Isi artikel harus diisi',
                ]
            );
            $image_file = 'image_' . time() . '.' . $request->image->extension();
            $old_image = public_path('assets/images/blog/' . $data->image);
            if (file_exists($old_image) && is_file($old_image)) {
                unlink($old_image);
            }
            $data->update([
                'title' => $request->title,
                'slug'  => str_replace(' ', '-', $request->title),
                'article'  => $request->body,
                'image' => $image_file,
                'user_id' => auth()->user()->id,
            ]);
            $request->image->move(public_path('assets/images/blog'), $image_file);
        }

        return redirect()->route('admin.article')->with('success', 'Artikel telah diubah');
    }

    public function destroy($id)
    {
        if ($id > 3) {
            $data = Article::find($id);
            $old_image = public_path('assets/images/blog/' . $data->image);
            if (file_exists($old_image) && is_file($old_image)) {
                unlink($old_image);
            }          
            $data->delete();
        }

        return redirect()->route('admin.article')->with('success', 'Artikel telah dihapus');
    }
}
