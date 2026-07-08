<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Projecten';
$categories = project_categories();
$filter = $_GET['categorie'] ?? 'alle';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <p class="kicker">Portfolio</p>
        <h1 class="display-xl">Projecten</h1>
        <p class="lead">Een overzicht van door Studio Vendrig gerealiseerde en lopende projecten.</p>
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
            <div class="category-block">
                <h2 class="category-title"><span><?= e($cat) ?></span></h2>
                <div class="project-grid">
                    <?php foreach ($items as $i => $p): ?>
                    <a class="project-card reveal" href="project.php?id=<?= $p['id'] ?>">
                        <div class="project-card-img">
                            <?php if ($p['images']): ?>
                                <img src="<?= e($p['images'][0]['file']) ?>" alt="<?= e($p['title']) ?>" loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div class="project-card-body">
                            <span class="project-card-cat"><?= e($cat) ?></span>
                            <h3><?= e($p['title']) ?></h3>
                            <span class="project-card-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
