<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diendan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DiendanController extends Controller
{
    public function index(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        $query = Diendan::query();

        // Tìm kiếm theo tên diễn đàn
        if ($request->has('ten_dien_dan') && !empty($request->ten_dien_dan)) {
            $query->where('ten_dien_dan', 'like', '%' . trim($request->ten_dien_dan) . '%');
        }

        // Tìm kiếm theo tên giảng viên
        if ($request->has('ten_giang_vien') && !empty($request->ten_giang_vien)) {
            $query->where('ten_giang_vien', 'like', '%' . trim($request->ten_giang_vien) . '%');
        }

        // Tìm kiếm theo loại thảo luận
        if ($request->has('loai_thao_luan') && !empty($request->loai_thao_luan)) {
            $query->where('loai_thao_luan', $request->loai_thao_luan);
        }

        // Tìm kiếm theo ngày tạo
        if ($request->has('ngay_tao_tu') && !empty($request->ngay_tao_tu)) {
            $query->whereDate('ngay_tao', '>=', $request->ngay_tao_tu);
        }
        if ($request->has('ngay_tao_den') && !empty($request->ngay_tao_den)) {
            $query->whereDate('ngay_tao', '<=', $request->ngay_tao_den);
        }

        $diendans = $query->paginate(10);
        
        // Thêm các tham số tìm kiếm vào URL phân trang
        $diendans->appends($request->all());

        // Kiểm tra vai trò người dùng để trả về view phù hợp
        if ($user && $user->role === 'student') {
            // Trả về view cho học viên
            return view('students.diendan.index', compact('diendans'));
        } else {
            // Trả về view cho giảng viên hoặc các vai trò khác
            return view('user.diendan.quanlydiendan', compact('diendans'));
        }
    }

    public function indexForStudents(Request $request)
    {
        $diendans = Diendan::paginate(5);
        return view('user.diendan.diendan', compact('diendans'));
        $query = Diendan::query();

        // Tìm kiếm theo tên diễn đàn
        if ($request->has('ten_dien_dan') && !empty($request->ten_dien_dan)) {
            $query->where('ten_dien_dan', 'like', '%' . trim($request->ten_dien_dan) . '%');
        }

        // Tìm kiếm theo tên giảng viên
        if ($request->has('ten_giang_vien') && !empty($request->ten_giang_vien)) {
            $query->where('ten_giang_vien', 'like', '%' . trim($request->ten_giang_vien) . '%');
        }

        // Tìm kiếm theo loại thảo luận
        if ($request->has('loai_thao_luan') && !empty($request->loai_thao_luan)) {
            $query->where('loai_thao_luan', $request->loai_thao_luan);
        }

        // Tìm kiếm theo ngày tạo
        if ($request->has('ngay_tao_tu') && !empty($request->ngay_tao_tu)) {
            $query->whereDate('ngay_tao', '>=', $request->ngay_tao_tu);
        }
        if ($request->has('ngay_tao_den') && !empty($request->ngay_tao_den)) {
            $query->whereDate('ngay_tao', '<=', $request->ngay_tao_den);
        }

        $diendans = $query->paginate(5);
        
        // Thêm các tham số tìm kiếm vào URL phân trang
        $diendans->appends($request->all());

        return view('user.diendan.diendan', compact('diendans'));
    }

    public function create()
    {
        return view('user.diendan.themdiendan');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten_dien_dan' => 'required|string|max:255|unique:diendan,ten_dien_dan',
            'loai_thao_luan' => 'required|in:public,anonymous',
            'ten_giang_vien' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'ten_dien_dan.required' => 'Tên diễn đàn là bắt buộc',
            'ten_dien_dan.unique' => 'Tên diễn đàn đã có, vui lòng nhập tên khác',
            'ten_dien_dan.max' => 'Tên diễn đàn không được vượt quá 255 ký tự',
            'loai_thao_luan.required' => 'Loại thảo luận là bắt buộc',
            'loai_thao_luan.in' => 'Loại thảo luận không hợp lệ',
            'ten_giang_vien.required' => 'Tên giảng viên là bắt buộc',
            'ten_giang_vien.regex' => 'Tên giảng viên chỉ được chứa chữ cái và khoảng trắng',
            'background_image.required' => 'Ảnh nền diễn đàn là bắt buộc',
            'background_image.image' => 'File phải là ảnh',
            'background_image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'background_image.max' => 'Kích thước ảnh không được vượt quá 2MB',
            'images.max' => 'Không được upload quá 5 ảnh',
            'images.*.image' => 'Tất cả các file phải là ảnh',
            'images.*.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'images.*.max' => 'Kích thước mỗi ảnh không được vượt quá 2MB'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Kiểm tra và xử lý ảnh nền
            $backgroundImagePath = null;
            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                if ($file->isValid()) {
                    $backgroundImagePath = $file->store('diendan_backgrounds', 'public');
                } else {
                    throw new \Exception('File ảnh nền không hợp lệ');
                }
            }

            // Xử lý nhiều ảnh đính kèm
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('diendan_images', 'public');
                        $imagePaths[] = $path;
                    } else {
                        throw new \Exception('Một số ảnh đính kèm không hợp lệ');
                    }
                }
            }

            // Tạo mã diễn đàn tự động
            $lastDiendan = Diendan::orderBy('id', 'desc')->first();
            $newCode = $lastDiendan ? 'DD' . str_pad((int) substr($lastDiendan->ma_dien_dan, 2) + 1, 3, '0', STR_PAD_LEFT) : 'DD001';

            // Tạo diễn đàn mới
            Diendan::create([
                'ma_dien_dan' => $newCode,
                'ten_dien_dan' => trim($request->ten_dien_dan),
                'loai_thao_luan' => $request->loai_thao_luan,
                'ten_giang_vien' => trim($request->ten_giang_vien),
                'background_image' => $backgroundImagePath,
                'images' => !empty($imagePaths) ? json_encode($imagePaths) : null,
                'ngay_tao' => now()
            ]);

            DB::commit();
            return redirect()->route('diendan.index')->with('success', 'Thêm diễn đàn thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Xóa các file đã upload nếu có lỗi
            if (isset($backgroundImagePath)) {
                Storage::disk('public')->delete($backgroundImagePath);
            }
            if (!empty($imagePaths)) {
                foreach ($imagePaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $diendan = Diendan::findOrFail($id);
            return view('teacher.editdiendan', compact('diendan'));
        } catch (\Exception $e) {
            return redirect()->route('diendan.index')->with('error', 'Không tìm thấy diễn đàn');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $diendan = Diendan::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('diendan.index')->with('error', 'Không tìm thấy diễn đàn');
        }

        $validator = Validator::make($request->all(), [
            'ten_dien_dan' => 'required|string|max:255|unique:diendan,ten_dien_dan,' . $id,
            'loai_thao_luan' => 'required|in:public,anonymous',
            'ten_giang_vien' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'ten_dien_dan.required' => 'Tên diễn đàn là bắt buộc',
            'ten_dien_dan.unique' => 'Tên diễn đàn đã có, vui lòng nhập tên khác',
            'ten_dien_dan.max' => 'Tên diễn đàn không được vượt quá 255 ký tự',
            'loai_thao_luan.required' => 'Loại thảo luận là bắt buộc',
            'loai_thao_luan.in' => 'Loại thảo luận không hợp lệ',
            'ten_giang_vien.required' => 'Tên giảng viên là bắt buộc',
            'ten_giang_vien.regex' => 'Tên giảng viên chỉ được chứa chữ cái và khoảng trắng',
            'background_image.image' => 'File phải là ảnh',
            'background_image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'background_image.max' => 'Kích thước ảnh không được vượt quá 2MB',
            'images.max' => 'Không được upload quá 5 ảnh',
            'images.*.image' => 'Tất cả các file phải là ảnh',
            'images.*.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'images.*.max' => 'Kích thước mỗi ảnh không được vượt quá 2MB'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Cập nhật các trường text
            $diendan->ten_dien_dan = trim($request->ten_dien_dan);
            $diendan->loai_thao_luan = $request->loai_thao_luan;
            $diendan->ten_giang_vien = trim($request->ten_giang_vien);

            // Xử lý ảnh nền mới nếu có
            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                if ($file->isValid()) {
                    // Xóa ảnh nền cũ
                    if ($diendan->background_image) {
                        Storage::disk('public')->delete($diendan->background_image);
                    }
                    $backgroundImagePath = $file->store('diendan_backgrounds', 'public');
                    $diendan->background_image = $backgroundImagePath;
                } else {
                    throw new \Exception('File ảnh nền không hợp lệ');
                }
            }

            // Xử lý ảnh đính kèm mới nếu có
            if ($request->hasFile('images')) {
                $currentImages = is_string($diendan->images) ? json_decode($diendan->images, true) : [];
                $currentImages = is_array($currentImages) ? $currentImages : [];

                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('diendan_images', 'public');
                        $currentImages[] = $path;
                    } else {
                        throw new \Exception('Một số ảnh đính kèm không hợp lệ');
                    }
                }

                // Giới hạn số lượng ảnh
                if (count($currentImages) > 5) {
                    throw new \Exception('Không được có quá 5 ảnh đính kèm');
                }

                $diendan->images = json_encode($currentImages);
            }

            $diendan->save();
            DB::commit();

            return redirect()->route('diendan.index')->with('success', 'Cập nhật diễn đàn thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $diendan = Diendan::findOrFail($id);
            
            // Xóa ảnh nền
            if ($diendan->background_image) {
                Storage::disk('public')->delete($diendan->background_image);
            }
            
            // Xóa các ảnh đính kèm
            if ($diendan->images) {
                $images = is_string($diendan->images) ? json_decode($diendan->images, true) : [];
                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
            
            // Xóa các tin nhắn liên quan
            \App\Models\DiendanMessage::where('diendan_id', $id)->delete();
            
            // Xóa diễn đàn
            $diendan->delete();
            
            DB::commit();
            return redirect()->route('diendan.index')->with('success', 'Xóa diễn đàn thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi xóa diễn đàn: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $diendan = Diendan::findOrFail($id);
            return view('diendan_show', compact('diendan'));
        } catch (\Exception $e) {
            return redirect()->route('diendan.index')->with('error', 'Không tìm thấy diễn đàn');
        }
    }

    public function chat($id)
    {
        try {
            $diendan = Diendan::with(['messages.user'])->find($id);

            if (!$diendan) {
                return redirect()->route('diendan.index')->with('error', 'Không tìm thấy diễn đàn với ID này.');
            }

            // Lấy danh sách tin nhắn, sắp xếp theo thời gian gửi tăng dần
            $messages = $diendan->messages()->orderBy('created_at', 'asc')->get();

            // Xác định xem người dùng hiện tại có phải là giảng viên hay không
            $currentUser = auth()->user();
            $isTeacher = ($currentUser && $currentUser->role === 'teacher');

            return view('user.diendan.diendan_chat', compact('diendan', 'messages', 'isTeacher'));

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function chatSend(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ], [
            'content.required' => 'Nội dung tin nhắn không được để trống',
            'content.max' => 'Nội dung tin nhắn không được vượt quá 1000 ký tự'
        ]);

        try {
            $diendan = Diendan::findOrFail($id);
            $user = auth()->user();

            \App\Models\DiendanMessage::create([
                'diendan_id' => $diendan->id,
                'student_name' => $user->name,
                'content' => trim($request->content),
                'created_at' => now()
            ]);

            return back()->with('success', 'Gửi tin nhắn thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi gửi tin nhắn.');
        }
    }
}
