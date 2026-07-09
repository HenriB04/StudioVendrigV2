<?php
require_once __DIR__ . '/includes/functions.php';

$article = isset($_GET['id']) ? news_by_id((int)$_GET['id']) : null;

if (isset($_GET['id']) && !$article) {
    http_response_code(404);
}

$pageTitle = $article ? $article['title'] : 'Nieuws';
$bodyClass = $article ? 'page-article' : 'page-nieuws';
require __DIR__ . '/includes/header.php';
?>

<?php if ($article): ?>

<article class="article">
    <header class="article-masthead">
        <div class="container measure center">
            <p class="article-eyebrow">Nieuws &middot; Studio Vendrig</p>
            <p class="article-date"><?= e($article['date']) ?></p>
            <h1 class="article-title"><?= e($article['title']) ?></h1>
        </div>
    </header>

    <figure class="article-lead-image">
        <img src="<?= e($article['image']) ?>" alt="">
    </figure>

    <div class="container measure">
        <div class="rich-text drop"><?= $article['body'] ?></div>

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

        <p class="article-back"><a class="link-arrow back" href="nieuws.php">Archief bekijken</a></p>
    </div>
</article>

<?php else: ?>

<section class="page-hero">
    <div class="container">
        <p class="kicker">Actueel</p>
        <h1 class="display-xl">Nieuws</h1>
        <p class="lead">Berichten en publicaties van Studio Vendrig.</p>
    </div>
</section>

<?php
$items = news_items();
$feature = $items ? $items[0] : null;
$rest = array_slice($items, 1);
?>

<?php if (isset($_GET['id'])): ?>
<section class="section"><div class="container"><p class="lead">Het opgevraagde nieuwsbericht bestaat niet. Hieronder vindt u het volledige archief.</p></div></section>
<?php endif; ?>

<?php if ($feature): ?>
<section class="section news-feature-section">
    <a class="news-feature reveal" href="nieuws.php?id=<?= $feature['id'] ?>">
        <div class="news-feature-img">
            <img src="<?= e($feature['image']) ?>" alt="" loading="lazy">
        </div>
        <div class="news-feature-body">
            <span class="news-tag">Uitgelicht</span>
            <span class="news-date"><?= e($feature['date']) ?></span>
            <h2><?= e($feature['title']) ?></h2>
            <p><?= e($feature['summary']) ?></p>
            <span class="link-arrow">Lees het artikel</span>
        </div>
    </a>
</section>
<?php endif; ?>

<?php if ($rest): ?>
<section class="section news-archive">
    <div class="container">
        <h2 class="archive-title reveal">Archief</h2>
        <div class="news-list">
            <?php foreach ($rest as $n): ?>
            <a class="news-list-row reveal" href="nieuws.php?id=<?= $n['id'] ?>">
                <span class="news-list-date"><?= e($n['date']) ?></span>
                <span class="news-list-title"><?= e($n['title']) ?></span>
                <span class="news-list-arrow" aria-hidden="true">&rarr;</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
