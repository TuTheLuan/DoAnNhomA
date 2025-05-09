<?php

namespace App\Http\Controllers;

use App\Models\TaiLieuBaiHoc;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TaiLieuBaiHocController extends Controller
{
    public function destroy($id)
    {
        $tailieu = TaiLieuBaiHoc::findOrFail($id);

        // Xóa file vật lý nếu tồn tại
        if ($tailieu->file && Storage::disk('public')->exists($tailieu->file)) {
            Storage::disk('public')->delete($tailieu->file);
        }

        // Xóa bản ghi trong database
        $tailieu->delete();

        return back()->with('success', 'Tài liệu đã được xóa thành công!');
    }
}
