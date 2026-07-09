<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Projecten';
$bodyClass = 'page-projecten';
$categories = project_categories();
$filter = $_GET['categorie'] ?? 'alle';
$totaal = count(projects());
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero projecten-hero">
    <div class="container">
        <p class="kicker">Portfolio &mdash; <?= $totaal ?> projecten</p>
        <h1 class="display-xl">Projecten<span class="hero-dot-mark">.</span></h1>
        <p class="lead">Een overzicht van door Studio Vendrig gerealiseerde en lopende projecten,
        geordend per discipline.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="filter-bar" aria-label="Projectcategorie&euml;n">
            <a href="projecten.php" class="filter-btn<?= $filter === 'alle' ? ' is-active' : '' ?>">Alle</a>
            <?php foreach (array_keys($categories) as $cat): ?>
                <a href="projecten.php?categorie=<?= urlencode($cat) ?>"
                   class="filter-btn<?= $filter === $cat ? ' is-active' : '' ?>"><?= e($cat) ?></a>
            <?php endforeach; ?>
        </div>

        <?php foreach ($categories as $cat => $items): ?>
            <?php if ($filter !== 'alle' && $filter !== $cat) continue; ?>
            <div class="cat-ledger">
                <div class="cat-ledger-head reveal">
                    <span class="cat-ledger-count"><?= str_pad((string)count($items), 2, '0', STR_PAD_LEFT) ?></span>
                    <h2><?= e($cat) ?></h2>
                </div>
                <div class="proj-index">
                    <?php foreach ($items as $i => $p): ?>
                    <a class="proj-row reveal" href="project.php?id=<?= $p['id'] ?>">
                        <span class="proj-row-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                        <span class="proj-row-thumb">
                            <?php if ($p['images']): ?>
                                <img src="<?= e($p['images'][0]['file']) ?>" alt="<?= e($p['title']) ?>" loading="lazy">
                            <?php endif; ?>
                        </span>
                        <span class="proj-row-title"><?= e($p['title']) ?></span>
                        <span class="proj-row-cat"><?= e($cat) ?></span>
                        <span class="proj-row-arrow" aria-hidden="true">&rarr;</span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
