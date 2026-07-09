<?php
require_once __DIR__ . '/includes/functions.php';

$project = project_by_id((int)($_GET['id'] ?? 0));
if (!$project) {
    http_response_code(404);
    $pageTitle = 'Project niet gevonden';
    require __DIR__ . '/includes/header.php';
    echo '<section class="page-hero"><div class="container"><h1 class="display-xl">Project niet gevonden</h1>'
       . '<p class="lead">Het opgevraagde project bestaat niet.</p>'
       . '<a class="link-arrow back" href="projecten.php">Terug naar projecten</a></div></section>';
    require __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $project['title'];
$bodyClass = 'page-project';
if ($project['images']) {
    $bodyClass .= ' has-dark-hero';
}
require __DIR__ . '/includes/header.php';
?>

<?php if ($project['images']): ?>
<section class="project-hero" style="background-image:url('<?= e($project['images'][0]['file']) ?>')">
    <div class="hero-scrim"></div>
    <div class="hero-content container">
        <p class="kicker on-dark"><?= e($project['category']) ?></p>
        <h1 class="hero-title small"><?= e($project['title']) ?></h1>
    </div>
</section>
<?php else: ?>
<section class="page-hero">
    <div class="container">
        <p class="kicker"><?= e($project['category']) ?></p>
        <h1 class="display-xl"><?= e($project['title']) ?></h1>
    </div>
</section>
<?php endif; ?>

<section class="section project-article">
    <div class="container measure">
        <?php if (trim($project['description']) !== ''): ?>
            <div class="rich-text"><?= $project['description'] ?></div>
        <?php else: ?>
            <div class="rich-text">
                <p><em>Dit project is momenteel in uitvoering. Meer informatie volgt binnenkort.</em></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if ($project['images']): ?>
<section class="project-plates">
    <?php foreach ($project['images'] as $i => $img): ?>
    <figure class="plate plate-<?= $i % 3 ?> reveal">
        <a href="<?= e($img['file']) ?>" class="gallery-link">
            <img src="<?= e($img['file']) ?>" alt="<?= e($img['name']) ?>" loading="lazy">
        </a>
        <figcaption>
            <span class="plate-cap-name"><?= e($img['name']) ?></span>
            <span class="plate-cap-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?> / <?= str_pad((string)count($project['images']), 2, '0', STR_PAD_LEFT) ?></span>
        </figcaption>
    </figure>
    <?php endforeach; ?>
</section>
<?php endif; ?>

<section class="section project-foot">
    <div class="container">
        <a class="link-arrow back" href="projecten.php">Terug naar projecten</a>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
