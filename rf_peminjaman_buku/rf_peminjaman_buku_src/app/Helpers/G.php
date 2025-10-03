<?php
namespace App\Helpers;

class G {
    public static function dd($inp) {
        return dd($inp);
    }

    public static function ddp($inp) {
        echo "<pre>";
        var_dump($inp);
        echo "</pre>";
        die;
    }

    public static function pgnPrevious($currentPage) {
        $tmp = (int)$currentPage;
        return 
        $tmp <= 1 ? 
        [ 'index' => 1, 'disabled' => true ] : 
        [ 'index' => $tmp - 1, 'disabled' => false ];
    }

    public static function pgnNext($currentPage, $totalPage) {
        $tmp = (int)$currentPage;
        return
        $tmp >= $totalPage ? 
        [ 'index' => $totalPage, 'disabled' => true ] : 
        [ 'index' => $tmp + 1, 'disabled' => false ];
    }

    //
    public static function getSystemInfo()
    {
        return [
            'PHP Version'        => phpversion(),
            'Server Software'    => $_SERVER['SERVER_SOFTWARE'] ?? 'CLI',
            'Server OS'          => php_uname('s') . ' ' . php_uname('r'),
            'Memory Usage'       => G::formatBytes(memory_get_usage(true)),
            'Max Memory Limit'   => ini_get('memory_limit'),
            'Upload Max Size'    => ini_get('upload_max_filesize'),
            'Post Max Size'      => ini_get('post_max_size'),
            'Execution Time'     => ini_get('max_execution_time') . ' sec',
            'Current Time'       => date('Y-m-d H:i:s'),
        ];
    }

    public static function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

}