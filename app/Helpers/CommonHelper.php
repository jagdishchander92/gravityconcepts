<?php
if (!function_exists('pre')) {
    function pre($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
if (!function_exists('imgUrl')) {
    function imgUrl($url)
    {
        return strstr($url, '/storage/');
    }
}
if (!function_exists('changeSize()')) {
    function changeSize($url, $append)
    {
        $pathInfo = pathinfo($url);

        $dirname   = $pathInfo['dirname'] ?? '';
        $filename  = $pathInfo['filename'] ?? '';
        $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';

        $newFilename = $filename . '-' . $append . $extension;

        return ($dirname && $dirname !== '.')
            ? $dirname . '/' . $newFilename
            : $newFilename;
    }
}

// function renderNode($node)
// {
//     return view(
//         'builder.render-node',
//         compact('node')
//     )->render();
// }
