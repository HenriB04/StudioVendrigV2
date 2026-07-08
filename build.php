<?php
/**
 * Statische build voor GitHub Pages.
 *
 * Rendert alle PHP-pagina's naar HTML in de map docs/ en herschrijft
 * interne links (bijv. project.php?id=8 -> project-8.html).
 *
 * Gebruik:  C:\php\php.exe build.php
 * Daarna committen en pushen; GitHub Pages serveert de map docs/.
 */

define('STATIC_BUILD', true);

require __DIR__ . '/includes/functions.php';

$out = __DIR__ . '/docs';

/** Rendert een pagina zoals de webserver dat zou doen. */
function render_page(string $file, array $get = []): string
{
    $_GET = $get;
    $_SERVER['SCRIPT_NAME'] = '/' . $file;
    $_SERVER['REQUEST_METHOD'] = 'GET';
    ob_start();
    include __DIR__ . '/' . $file;
    return ob_get_clean();
}

function rrmdir(string $dir): void
{
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = "$dir/$item";
        is_dir($path) ? rrmdir($path) : unlink($path);
    }
    rmdir($dir);
}

function rcopy(string $src, string $dst): void
{
    mkdir($dst, 0777, true);
    foreach (scandir($src) as $item) {
        if ($item === '.' || $item === '..') continue;
        $s = "$src/$item";
        $d = "$dst/$item";
        is_dir($s) ? rcopy($s, $d) : copy($s, $d);
    }
}

// ---------------------------------------------------------------------------
// Routes bepalen
// ---------------------------------------------------------------------------
$routes = [
    'index.html'        => ['index.php', []],
    'projecten.html'    => ['projecten.php', []],
    'studio.html'       => ['studio.php', []],
    'nieuws.html'       => ['nieuws.php', []],
    'samenwerking.html' => ['samenwerking.php', []],
    'contact.html'      => ['contact.php', []],
];

$linkMap = []; // oud => nieuw, langste eerst toepassen

foreach (array_keys(project_categories()) as $cat) {
    $slug = strtolower($cat);
    $routes["projecten-$slug.html"] = ['projecten.php', ['categorie' => $cat]];
    $linkMap['projecten.php?categorie=' . urlencode($cat)] = "projecten-$slug.html";
}
foreach (projects() as $p) {
    $routes["project-{$p['id']}.html"] = ['project.php', ['id' => (string)$p['id']]];
    $linkMap["project.php?id={$p['id']}"] = "project-{$p['id']}.html";
}
foreach (news_items() as $n) {
    $routes["nieuws-{$n['id']}.html"] = ['nieuws.php', ['id' => (string)$n['id']]];
    $linkMap["nieuws.php?id={$n['id']}"] = "nieuws-{$n['id']}.html";
}
foreach (array_keys(NAV) as $file) {
    $linkMap[$file] = str_replace('.php', '.html', $file);
}

// Langste sleutels eerst, zodat 'nieuws.php?id=4' vóór 'nieuws.php' vervangen wordt
uksort($linkMap, fn($a, $b) => strlen($b) <=> strlen($a));

// ---------------------------------------------------------------------------
// Bouwen
// ---------------------------------------------------------------------------
rrmdir($out);
mkdir($out, 0777, true);

foreach ($routes as $target => [$file, $get]) {
    $html = render_page($file, $get);
    $html = strtr($html, $linkMap);
    file_put_contents("$out/$target", $html);
    echo "  $target\n";
}

rcopy(__DIR__ . '/assets', "$out/assets");
file_put_contents("$out/.nojekyll", '');

echo "\nKlaar: " . count($routes) . " pagina's gebouwd in docs/\n";
