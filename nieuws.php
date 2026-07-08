<?php
require_once __DIR__ . '/includes/functions.php';

$article = isset($_GET['id']) ? news_by_id((int)$_GET['id']) : null;

if (isset($_GET['id']) && !$article) {
    http_response_code(404);
}

$pageTitle = $article ? $article['title'] : 'Nieuws';
require __DIR__ . '/includes/header.php';
?>

<?php if ($article): ?>

<section class="page-hero">
    <div class="container narrow">
        <p class="kicker"><?= e($article['date']) ?></p>
        <h1 class="display-xl"><?= e($article['title']) ?></h1>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <figure class="article-image reveal">
            <img src="<?= e($article['image']) ?>" alt="">
        </figure>
        <div class="rich-text"><?= $article['body'] ?></div>

        <?php if ($article['attachments']): ?>
            <div class="attachments">
                <h3>Bijlagen</h3>
                <ul>
                    <?php foreach ($article['attachments'] as $att): ?>
                        <li><a href="<?= e($att['file']) ?>" target="_blank" rel="noopener">&#128196; <?= e($att['label']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <p><a class="link-arrow back" href="nieuws.php">Archief bekijken</a></p>
    </div>
</section>

<?php else: ?>

<section class="page-hero">
    <div class="container">
        <p class="kicker">Actueel</p>
        <h1 class="display-xl">Nieuws</h1>
        <p class="lead">Berichten en publicaties van Studio Vendrig.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (isset($_GET['id'])): ?>
            <p class="lead">Het opgevraagde nieuwsbericht bestaat niet. Hieronder vindt u het volledige archief.</p>
        <?php endif; ?>
        <div class="news-grid">
            <?php foreach (news_items() as $n): ?>
            <a class="news-card reveal" href="nieuws.php?id=<?= $n['id'] ?>">
                <div class="news-card-img">
                    <img src="<?= e($n['image']) ?>" alt="" loading="lazy">
                </div>
                <div class="news-card-body">
                    <span class="news-date"><?= e($n['date']) ?></span>
                    <h3><?= e($n['title']) ?></h3>
                    <p><?= e($n['summary']) ?></p>
                    <span class="link-arrow">Lees meer</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
