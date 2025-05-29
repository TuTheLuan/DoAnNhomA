<?php

namespace App\Helpers;

class ForumHelper
{
    /**
     * Tạo tên ẩn danh từ tên người dùng
     * 
     * @param string $name Tên người dùng
     * @return string Tên ẩn danh (ví dụ: "Ẩn danh a1b2")
     */
    public static function getAnonymousName($name)
    {
        $hash = substr(md5($name), 0, 4);
        return 'Ẩn danh ' . $hash;
    }
} 