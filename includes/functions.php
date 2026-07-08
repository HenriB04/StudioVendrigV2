<?php
/**
 * Studio Vendrig V2 — gedeelde configuratie en helpers.
 * Alle inhoud is 1-op-1 overgenomen van www.studiovendrig.nl
 */

const SITE_NAME    = 'Studio Vendrig';
const SITE_TAGLINE = 'Wij creëren de juiste omgeving';

const CONTACT = [
    'bezoekadres' => ['Meidoornkade 22', '3992 AE HOUTEN'],
    'postadres'   => ['Postbus 75', '3417 ZH MONTFOORT'],
    'telefoon'    => '030 - 688 48 90',
    'fax'         => '030 - 601 26 83',
    'email'       => 'info@studiovendrig.nl',
    'website'     => 'www.studiovendrig.nl',
];

const DIENSTEN = ['Bouwkunst', 'Bouwtechniek', 'Projectmanagment'];

const NAV = [
    'index.php'        => 'Home',
    'projecten.php'    => 'Projecten',
    'studio.php'       => 'Studio',
    'nieuws.php'       => 'Nieuws',
    'samenwerking.php' => 'Samenwerking',
    'contact.php'      => 'Contact',
];

function projects(): array
{
    static $projects = null;
    if ($projects === null) {
        $projects = require __DIR__ . '/data.php';
    }
    return $projects;
}

function project_by_id(int $id): ?array
{
    foreach (projects() as $p) {
        if ($p['id'] === $id) {
            return $p;
        }
    }
    return null;
}

function project_categories(): array
{
    $cats = [];
    foreach (projects() as $p) {
        $cats[$p['category']][] = $p;
    }
    return $cats;
}

function news_items(): array
{
    static $news = null;
    if ($news === null) {
        $news = require __DIR__ . '/news.php';
    }
    return $news;
}

function news_by_id(int $id): ?array
{
    foreach (news_items() as $n) {
        if ($n['id'] === $id) {
            return $n;
        }
    }
    return null;
}

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/** Actieve navigatie-item bepalen op basis van het huidige script. */
function is_active(string $page): bool
{
    $current = basename($_SERVER['SCRIPT_NAME']);
    if ($page === 'projecten.php' && $current === 'project.php') {
        return true;
    }
    return $current === $page;
}
