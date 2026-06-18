@echo off
REM ==============================================================
REM  Local dev server for the HENI Chemicals site.
REM
REM  DO NOT use "php artisan serve" for this project -- it uses
REM  public/ as the web root, so the templates' asset('public/...')
REM  URLs 404 and no CSS/JS/images load.
REM
REM  This launcher serves the PROJECT ROOT as the web root (same as
REM  production), so /public/... URLs resolve correctly.
REM ==============================================================
cd /d "%~dp0"
echo Starting local server at http://127.0.0.1:8000
echo Press Ctrl+C to stop.
"C:\xampp\php\php.exe" -S 127.0.0.1:8000 serve-local.php
