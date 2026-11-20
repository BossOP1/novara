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

// Child mode: render one page in a fresh PHP process so pages can't clash
// (each page declares its own helpers and variables).
if (($argv[1] ?? '') === '--render') {
    chdir(dirname($root . '/' . $argv[2]));
    include $root . '/' . $argv[2];
    exit(0);
}

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
    'index.php'                   => 'index.html',
    'assets/lp/tms/index.php'     => 'lp/tms/index.html',
    'assets/lp/tms/thank-you.php' => 'lp/tms/thank-you/index.html',
];

foreach ($pages as $src => $dest) {
    $cmd  = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__FILE__) . ' --render ' . escapeshellarg($src);
    $proc = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
    $html = stream_get_contents($pipes[1]);
    $err  = stream_get_contents($pipes[2]);
    fclose($pipes[1]); fclose($pipes[2]);
    if (proc_close($proc) !== 0) {
        fwrite(STDERR, "✗ Failed to render {$src}: " . trim($err ?: $html) . "\n");
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

/* ---------- Static assets ---------- */
function copy_dir(string $from, string $to): int {
    $count = 0;
    if (!is_dir($to)) mkdir($to, 0755, true);
    foreach (new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($from, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    ) as $item) {
        // Never publish source files or internal documents
        if ($item->getFilename() === '.DS_Store' || preg_match('/\.(php|docx?|md|heic)$/i', $item->getFilename())) continue;
        $target = $to . '/' . substr($item->getPathname(), strlen($from) + 1);
        if ($item->isDir()) {
            is_dir($target) || mkdir($target, 0755, true);
        } else {
            copy($item->getPathname(), $target);
            $count++;
        }
    }
    return $count;
}

// /assets → dist/assets (hero video, poster, images referenced by the page)
if (is_dir($root . '/assets')) {
    printf("✓ Copied %d file(s) from /assets\n", copy_dir($root . '/assets', $dist . '/assets'));
}
// /public → site root (favicons, verification files, etc.)
if (is_dir($root . '/public')) {
    printf("✓ Copied %d file(s) from /public\n", copy_dir($root . '/public', $dist));
}

// Fail the build if a local asset any page references is missing
foreach ($pages as $dest) {
    preg_match_all('#(?:src|poster|data-src|href)="/?(assets/[^"\s]+)"|[\s"](/assets/[^"\s,]+\.(?:jpe?g|png|webp|mp4|svg))#', file_get_contents($dist . '/' . $dest), $m);
    foreach (array_unique(array_filter(array_merge($m[1], $m[2]))) as $asset) {
        if (!is_file($dist . '/' . ltrim($asset, '/'))) {
            fwrite(STDERR, "✗ Missing asset referenced by {$dest}: {$asset}\n");
            exit(1);
        }
    }
}

/* ---------- robots.txt ---------- */
if (!is_file($dist . '/robots.txt')) {
    file_put_contents($dist . '/robots.txt', "User-agent: *\nAllow: /\n");
    echo "✓ robots.txt\n";
}

echo "Build complete → dist/\n";
