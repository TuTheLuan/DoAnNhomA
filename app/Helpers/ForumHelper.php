<?php

namespace App\Helpers;

class ForumHelper
{
    public static function getAnonymousName($name)
    {
        $hash = substr(md5($name), 0, 4);
        return 'Ẩn danh ' . $hash;
    }
} 