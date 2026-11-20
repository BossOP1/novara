<?php
/**
 * Standalone build of the Sugar Land TMS landing page, for its own Netlify site.
 *
 *   php build-lp.php                                  → dist-lp/ (+ dist-lp.zip)
 *   php build-lp.php --url=https://tms.example.com/   → also sets the canonical URL
 *
 * Output: / (landing page), /thank-you/, /img/. Netlify Forms picks up the
 * "tms-lp" form automatically, also on drag-and-drop deploys.
 * The main site build (build.php) is unaffected and still publishes /lp/tms/.
 */

declare(strict_types=1);

set_error_handler(function (int $no, string $msg, string $file, int $line): bool {
    throw new ErrorException($msg, 0, $no, $file, $line);
});

$root = __DIR__;
$src  = $root . '/lp/tms';

// Child mode: render one page in a fresh PHP process
if (($argv[1] ?? '') === '--render') {
    define('STATIC_BUILD', true);
    define('LP_BASE', '/');
    define('LP_URL', $argv[3] ?? '');
    chdir($src);
    include $src . '/' . $argv[2];
    exit(0);
}

$url = '';
foreach ($argv as $a) {
    if (str_starts_with($a, '--url=')) $url = rtrim(substr($a, 6), '/') . '/';
}

$dist = $root . '/dist-lp';

function rrmdir(string $dir): void {
    if (!is_dir($dir)) return;
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $i) {
        $i->isDir() ? rmdir($i->getPathname()) : unlink($i->getPathname());
    }
    rmdir($dir);
}
rrmdir($dist);
mkdir($dist . '/img', 0755, true);

/* ---------- Render pages ---------- */
$pages = ['index.php' => 'index.html', 'thank-you.php' => 'thank-you/index.html'];
foreach ($pages as $page => $dest) {
    $cmd  = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__FILE__) . ' --render ' . escapeshellarg($page) . ' ' . escapeshellarg($url);
    $proc = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
    $html = stream_get_contents($pipes[1]);
    $err  = stream_get_contents($pipes[2]);
    fclose($pipes[1]); fclose($pipes[2]);
    if (proc_close($proc) !== 0 || stripos($html, '</html>') === false) {
        fwrite(STDERR, "✗ Failed to render {$page}: " . trim($err ?: $html) . "\n");
        exit(1);
    }
    is_dir(dirname($dist . '/' . $dest)) || mkdir(dirname($dist . '/' . $dest), 0755, true);
    file_put_contents($dist . '/' . $dest, $html);
    printf("✓ %s → dist-lp/%s (%s KB)\n", $page, $dest, number_format(strlen($html) / 1024, 1));
}

/* ---------- Images ---------- */
$n = 0;
foreach (glob($src . '/img/*.{jpg,jpeg,png,webp,svg}', GLOB_BRACE) as $f) {
    copy($f, $dist . '/img/' . basename($f));
    $n++;
}
echo "✓ Copied {$n} image(s)\n";

// Fail if a page references a local file that wasn't published
foreach ($pages as $dest) {
    preg_match_all('#(?:src|href)="(/img/[^"]+)"|[\s"](/img/[^"\s,]+)#', file_get_contents($dist . '/' . $dest), $m);
    foreach (array_unique(array_filter(array_merge($m[1], $m[2]))) as $asset) {
        if (!is_file($dist . $asset)) { fwrite(STDERR, "✗ Missing {$asset} in {$dest}\n"); exit(1); }
    }
}

/* ---------- Netlify config + robots ---------- */
file_put_contents($dist . '/netlify.toml', <<<'TOML'
# Standalone landing page. Already built: publish this folder as-is.
[build]
  publish = "."

[[headers]]
  for = "/*"
  [headers.values]
    X-Robots-Tag = "noindex"
    X-Content-Type-Options = "nosniff"
    Referrer-Policy = "strict-origin-when-cross-origin"

[[headers]]
  for = "/img/*"
  [headers.values]
    Cache-Control = "public, max-age=31536000"
TOML);
file_put_contents($dist . '/robots.txt', "User-agent: *\nAllow: /\n");
echo "✓ netlify.toml, robots.txt\n";

/* ---------- Zip for drag-and-drop ---------- */
if (class_exists('ZipArchive')) {
    if (is_file($root . '/dist-lp.zip')) unlink($root . '/dist-lp.zip');
    $zip = new ZipArchive();
    $zip->open($root . '/dist-lp.zip', ZipArchive::CREATE);
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dist, FilesystemIterator::SKIP_DOTS)) as $f) {
        $zip->addFile($f->getPathname(), substr($f->getPathname(), strlen($dist) + 1));
    }
    $zip->close();
    echo "✓ dist-lp.zip\n";
}

echo "Build complete → dist-lp/\n";
