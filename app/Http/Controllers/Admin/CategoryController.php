<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Category::all();
        return view('admin.category.index', compact('data'));        
    }

    public function create()
    {        
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_category' => 'required|unique:categories',
        ],
        [
            'title_category.required' => 'Nama Kategori harus diisi',
            'title_category.unique' => 'Nama Kategori sudah ada',            
        ]);
        Category::create([
            'title_category' => $request->title_category,
            'slug_category'  => str_replace(' ', '-', $request->title_category)
        ]);
        return redirect()->route('admin.category')->with('success', 'Kategori baru telah ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::all();
        $data = Category::findorfail($id);
        return view('admin.category.edit', compact('data', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = Category::find($id);
        $request->validate([
            'title_category' => 'required|unique:categories',
        ]);
        $data->update([
            'title_category' => $request->title_category,
            'slug_category'  => str_replace(' ', '-', $request->title_category)
        ]);

        return redirect()->route('admin.category')->with('success', 'Kategori telah diubah');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.category')->with('success', 'Kategori telah dihapus');
    }
}
