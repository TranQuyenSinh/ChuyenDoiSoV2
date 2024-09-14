<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::paginate(20);
        return view('admin.banner.index', compact('banners'));
    }

    public function add()
    {
        return view('admin.banner.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'ten' => 'required',
        ]);
        $data = $request->all();
        Banner::create([
            'ten' => $data['ten'],
            'hinhanh' => ImageController::saveImage($data['hinhanh']),
            'thutu' => Banner::count() + 1,
            'trangthai' => $data['trangthai']
        ]);
        return to_route('admin.banner.index')->with('success', __('Thêm thành công'));
    }

    public function edit(Request $request, Banner $banner)
    {
        return view('admin.banner.edit', compact('Banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'ten' => 'required',
        ]);
        $data = $request->all();
        $banner->update([
            'ten' => $data['ten'],
            'thutu' => Banner::count() + 1,
            'trangthai' => $data['trangthai']
        ]);
        if ($data['hinhanh']) {
            ImageController::remove($banner->hinhanh);
            $banner->update(['hinhanh' => ImageController::saveImage($data['hinhanh'])]);
        }
        return to_route('admin.banner.index')->with('success', __('Cập nhật thành công'));
    }

    public function delete(Banner $banner)
    {
        if ($banner->hinhanh) {
            ImageController::remove($banner->hinhanh);
        }
        $banner->delete();
        return to_route('admin.banner.index');
    }
}
