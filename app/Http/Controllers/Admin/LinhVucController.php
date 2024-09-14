<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\LinhVuc;
use Illuminate\Http\Request;

class LinhVucController extends Controller
{
    public function index()
    {
        $linhvucs = LinhVuc::paginate(20);
        return view('admin.linhvuc.index', compact('linhvucs'));
    }

    public function add()
    {
        return view('admin.linhvuc.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'ten' => 'required',
        ]);
        $data = $request->all();
        LinhVuc::create([
            'ten' => $data['ten'],
            'hinhanh' => ImageController::saveImage($data['hinhanh']),
        ]);
        return to_route('admin.linhvuc.index')->with('success', __('Thêm thành công'));
    }

    public function edit(Request $request, LinhVuc $linhvuc)
    {
        return view('admin.linhvuc.edit', compact('LinhVuc'));
    }

    public function update(Request $request, LinhVuc $linhvuc)
    {
        $request->validate([
            'ten' => 'required',
        ]);
        $data = $request->all();
        $linhvuc->update([
            'ten' => $data['ten'],
        ]);
        if ($data['hinhanh']) {
            ImageController::remove($linhvuc->hinhanh);
            $linhvuc->update(['hinhanh' => ImageController::saveImage($data['hinhanh'])]);
        }
        return to_route('admin.linhvuc.index')->with('success', __('Cập nhật thành công'));
    }

    public function delete(LinhVuc $linhvuc)
    {
        if ($linhvuc->hinhanh) {
            ImageController::remove($linhvuc->hinhanh);
        }
        $linhvuc->delete();
        return to_route('admin.linhvuc.index');
    }
}
