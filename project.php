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
if ($project['images']) {
    $bodyClass = 'has-dark-hero';
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

<section class="section">
    <div class="container project-detail">
        <div class="project-info">
            <?php if (trim($project['description']) !== ''): ?>
                <div class="rich-text"><?= $project['description'] ?></div>
            <?php else: ?>
                <div class="rich-text">
                    <p><em>Dit project is momenteel in uitvoering. Meer informatie volgt binnenkort.</em></p>
                </div>
            <?php endif; ?>
            <a class="link-arrow back" href="projecten.php">Terug naar projecten</a>
        </div>

        <?php if ($project['images']): ?>
        <div class="project-gallery">
            <?php foreach ($project['images'] as $i => $img): ?>
            <figure class="gallery-item reveal">
                <a href="<?= e($img['file']) ?>" class="gallery-link">
                    <img src="<?= e($img['file']) ?>" alt="<?= e($img['name']) ?>" loading="lazy">
                </a>
            </figure>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
