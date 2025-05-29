<?php
if (!function_exists('getAnonymousName')) {
    function getAnonymousName($name) {
        $hash = substr(md5($name), 0, 4);
        return 'Ẩn danh ' . $hash;
    }
} 