<?php

/**
 * Laravel dev router for the PHP built-in server (used by `php artisan serve`).
 *
 * This project's templates reference assets with a `public/...` prefix because
 * production serves the app from the project root (Apache + the root .htaccess).
 * Under `php artisan serve` the web root is `public/`, so those `/public/...`
 * URLs would normally 404. This router maps them back to the real files so that
 * `php artisan serve` works exactly like production for local development.
 *
 * Production never uses this file (Apache loads public/index.php directly).
 */

$publicPath = __DIR__.'/public';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '');

// 1) A real file directly under the public root (e.g. /favicon.ico, /frontend/...)
//    Let the built-in server serve it as-is.
if ($uri !== '/' && is_file($publicPath.$uri)) {
    return false;
}

// 2) Asset requested with the /public/ prefix (e.g. /public/frontend/css/style.css).
//    The web root is already public/, so stream the file from public/<rest>.
if (strpos($uri, '/public/') === 0) {
    $file = $publicPath.substr($uri, strlen('/public'));

    if (is_file($file)) {
        static $mimes = [
            'css'  => 'text/css',
            'js'   => 'application/javascript',
            'mjs'  => 'application/javascript',
            'json' => 'application/json',
            'map'  => 'application/json',
            'svg'  => 'image/svg+xml',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'ico'  => 'image/x-icon',
            'woff' => 'font/woff',
            'woff2'=> 'font/woff2',
            'ttf'  => 'font/ttf',
            'otf'  => 'font/otf',
            'eot'  => 'application/vnd.ms-fontobject',
            'mp4'  => 'video/mp4',
            'webm' => 'video/webm',
            'pdf'  => 'application/pdf',
            'txt'  => 'text/plain',
            'xml'  => 'application/xml',
        ];
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (isset($mimes[$ext])) {
            header('Content-Type: '.$mimes[$ext]);
        }
        header('Content-Length: '.filesize($file));
        header('Cache-Control: public, max-age=3600');
        readfile($file);
        return true;
    }
}

// 3) Everything else -> Laravel front controller.
require_once $publicPath.'/index.php';
