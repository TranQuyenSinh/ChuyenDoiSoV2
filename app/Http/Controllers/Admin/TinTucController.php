<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TinTucController extends Controller
{
    public function index()
    {
        $tintucs = TinTuc::paginate(20);
        return view('admin.tintuc.index', compact('tintucs'));
    }

    public function add()
    {
        return view('admin.tintuc.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'tieude' => 'required',
            'tomtat' => 'required',
            'noidung' => 'required',
            'linhvuc_id' => 'required|exists:linhvuc,_id',
        ]);
        $data = $request->all();
        TinTuc::create([
            'tieude' => $data['tieude'],
            'tomtat' => $data['tomtat'],
            'noidung' => $data['noidung'],
            'linhvuc_id' => $data['linhvuc_id'],
            'nguon' => $data['nguon'],
            'trangthai' => $data['trangthai'] ?? true,
            'user_id' => Auth::id(),
            'luotxem' => 0,
            'hinhanh' => ImageController::saveImage($data['hinhanh'])
        ]);

        return to_route('admin.tintuc.index')->with('success', __('Thêm thành công'));
    }

    public function edit(Request $request, TinTuc $tintuc)
    {
        return view('admin.tintuc.edit', compact('tintuc'));
    }

    public function update(Request $request, TinTuc $tintuc)
    {
        $request->validate([
            'tieude' => 'required',
            'tomtat' => 'required',
            'noidung' => 'required',
            'linhvuc_id' => 'required|exists:linhvuc,_id',
        ]);
        $data = $request->all();
        $tintuc->update([
            'tieude' => $data['tieude'],
            'tomtat' => $data['tomtat'],
            'noidung' => $data['noidung'],
            'linhvuc_id' => $data['linhvuc_id'],
            'nguon' => $data['nguon'],
            'trangthai' => $data['trangthai'] ?? true,
        ]);
        if ($data['hinhanh']) {
            ImageController::remove($tintuc->hinhanh);
            $tintuc->update(['hinhanh' => ImageController::saveImage($data['hinhanh'])]);
        }
        return to_route('admin.tintuc.index')->with('success', __('Cập nhật thành công'));
    }

    public function delete(TinTuc $tintuc)
    {
        if ($tintuc->hinhanh) {
            ImageController::remove($tintuc->hinhanh);
        }
        $tintuc->delete();
        return to_route('admin.tintuc.index');
    }
}
