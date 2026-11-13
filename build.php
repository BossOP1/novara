<?php
/**
 * Static build for Netlify.
 *
 * Netlify serves static files only, so this renders index.php to
 * dist/index.html at build time. Run locally with:  php build.php
 */

declare(strict_types=1);

// Fail the build on any PHP notice/warning instead of deploying broken HTML.
set_error_handler(function (int $no, string $msg, string $file, int $line): bool {
    throw new ErrorException($msg, 0, $no, $file, $line);
});

define('STATIC_BUILD', true);

$root = __DIR__;
$dist = $root . '/dist';

/* ---------- Clean output directory ---------- */
function rrmdir(string $dir): void {
    if (!is_dir($dir)) return;
    foreach (new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    ) as $item) {
        $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
    }
    rmdir($dir);
}
rrmdir($dist);
mkdir($dist, 0755, true);

/* ---------- Render pages ---------- */
$pages = [
    'index.php' => 'index.html',
];

foreach ($pages as $src => $dest) {
    ob_start();
    try {
        include $root . '/' . $src;
        $html = ob_get_clean();
    } catch (Throwable $e) {
        ob_end_clean();
        fwrite(STDERR, "✗ Failed to render {$src}: {$e->getMessage()} ({$e->getFile()}:{$e->getLine()})\n");
        exit(1);
    }

    if (trim($html) === '' || stripos($html, '</html>') === false) {
        fwrite(STDERR, "✗ {$src} rendered incomplete HTML\n");
        exit(1);
    }

    $target = $dist . '/' . $dest;
    if (!is_dir(dirname($target))) mkdir(dirname($target), 0755, true);
    file_put_contents($target, $html);
    printf("✓ %s → dist/%s (%s KB)\n", $src, $dest, number_format(strlen($html) / 1024, 1));
}

/* ---------- Static assets (optional) ---------- */
// Anything placed in /public is copied as-is to the site root (images, favicons, etc.).
$public = $root . '/public';
if (is_dir($public)) {
    foreach (new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($public, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    ) as $item) {
        $target = $dist . '/' . substr($item->getPathname(), strlen($public) + 1);
        $item->isDir() ? (is_dir($target) || mkdir($target, 0755, true)) : copy($item->getPathname(), $target);
    }
    echo "✓ Copied /public assets\n";
}

/* ---------- robots.txt ---------- */
if (!is_file($dist . '/robots.txt')) {
    file_put_contents($dist . '/robots.txt', "User-agent: *\nAllow: /\n");
    echo "✓ robots.txt\n";
}

echo "Build complete → dist/\n";
