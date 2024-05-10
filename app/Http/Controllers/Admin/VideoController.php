<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Video::all();
        return view('admin.video.index', compact('data'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|unique:videos',
                'body' => 'required',
                'image' => 'required|image|mimes:jpg,jpng,jpeg,png',
                'video' => 'required|mimes:mp4'
            ],
            [
                'title.required' => 'Judul video harus diisi',
                'title.unique' => 'Judul video sudah ada',
                'body.required' => 'Deskripsi video harus diisi',
                'image.required' => 'Gambar cover harus diisi',
                'image.image' => 'Gambar cover harus berupa gambar',
                'image.mimes' => 'Gambar cover harus bertipe jpg,jpng,jpeg,png',
                'video.mimes' => 'Gambar cover harus bertipe mp4',
                'video.required' => 'Gambar cover harus diisi',
            ]
        );

        $image_file = 'image_' . time() . '.' . $request->image->extension();
        $video_file = 'video_' . time() . '.' . $request->video->extension();
        Video::create([
            'title' => $request->title,
            'slug'  => str_replace(' ', '-', $request->title),
            'body'  => $request->body,
            'user_id' => auth()->user()->id,
            'image' => $image_file,
            'video' => $video_file,
        ]);
        $request->image->move(public_path('assets/images/education'), $image_file);
        $request->video->move(public_path('assets/videos'), $video_file);

        return redirect()->route('admin.video')->with('success', 'Video baru telah ditambahkan');
    }

    public function edit($id)
    {
        $data = Video::findorfail($id);
        return view('admin.video.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Video::find($id);


        $request->validate(
            [
                'title' => 'required',
                'body' => 'required',
            ],
            [
                'title.required' => 'Judul video harus diisi',
                'body.required' => 'Deskripsi video harus diisi',
            ]
        );
        if ($data->title != $request->title) {
            $request->validate(
                [
                    'title' => 'unique:articles',
                ],
                [
                    'title.unique' => 'Judul video sudah ada',
                ]
            );
        }
        $data->update([
            'title' => $request->title,
            'slug'  => str_replace(' ', '-', $request->title),
            'body'  => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        if ($request->image) {
            $image_file = 'image_' . time() . '.' . $request->image->extension();
            $old_image = public_path('assets/images/education/' . $data->image);
            if (file_exists($old_image) && is_file($old_image)) {
                unlink($old_image);
            }
            $data->update([
                'image' => $image_file,
            ]);
            $request->image->move(public_path('assets/images/education'), $image_file);
        }
        if ($request->video) {
            $video_file = 'video_' . time() . '.' . $request->video->extension();
            $old_video = public_path('assets/videos/' . $data->video);
            if (file_exists($old_video) && is_file($old_video)) {
                unlink($old_video);
            }
            $data->update([
                'video' => $video_file,
            ]);
            $request->video->move(public_path('assets/videos'), $video_file);
        }

        return redirect()->route('admin.video')->with('success', 'Video telah diubah');
    }

    public function destroy($id)
    {

        $data = Video::find($id);
        $old_video = public_path('assets/videos/' . $data->video);
        if (file_exists($old_video) && is_file($old_video)) {
            unlink($old_video);
        }
        $data->delete();


        return redirect()->route('admin.video')->with('success', 'Video telah dihapus');
    }
}
