<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NganhNghe;
use Illuminate\Http\Request;

class NganhNgheController extends Controller
{
    public function index()
    {
        $nganhnghes = NganhNghe::paginate(20);
        return view('admin.nganhnghe.index', compact('nganhnghes'));
    }

    public function add()
    {
        return view('admin.nganhnghe.add');
    }

    public function create(Request $request)
    {
        $validated =  $request->validate([
            'ten' => 'required',
            'linhvuc_id' => 'required|exists:linhvuc,_id',
        ]);
        NganhNghe::create($validated);
        return to_route('admin.nganhnghe.index')->with('success', __('Thêm thành công'));
    }

    public function edit(Request $request, NganhNghe $nganhnghe)
    {
        return view('admin.nganhnghe.edit', compact('nganhnghe'));
    }

    public function update(Request $request, NganhNghe $nganhnghe)
    {
        $validated = $request->validate([
            'ten' => 'required',
            'linhvuc_id' => 'required|exists:linhvuc,_id',
        ]);
        $nganhnghe->update($validated);
        return to_route('admin.nganhnghe.index')->with('success', __('Cập nhật thành công'));
    }

    public function delete(NganhNghe $nganhnghe)
    {
        $nganhnghe->delete();
        return to_route('admin.nganhnghe.index');
    }
}
