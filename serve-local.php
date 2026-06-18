<?php

/**
 * Local dev router for `php -S`.
 *
 * Production serves this app with the PROJECT ROOT as the document root
 * (Apache + the root .htaccess routes everything into public/index.php),
 * and the Blade templates reference assets as asset('public/...').
 *
 * Laravel's default `php artisan serve` uses public/ as the docroot, which
 * breaks those `/public/...` asset URLs. This router reproduces the
 * production layout: static files are served from the project root (so
 * /public/assets/... resolves to ./public/assets/...), and everything else
 * is handed to the Laravel front controller.
 *
 * Run from the project root:
 *   php -S 127.0.0.1:8000 serve-local.php
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Serve real files (css/js/images) directly, relative to the project root.
if ($uri !== '/' && file_exists(__DIR__.$uri) && ! is_dir(__DIR__.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
