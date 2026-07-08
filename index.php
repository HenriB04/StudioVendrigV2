<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = null; // homepage gebruikt de standaardtitel
$bodyClass = 'has-dark-hero';
$sliderImages = glob(__DIR__ . '/assets/img/slider/*.jpg');
require __DIR__ . '/includes/header.php';
?>

<!-- Hero met diavoorstelling -->
<section class="hero">
    <div class="hero-slides">
        <?php foreach ($sliderImages as $i => $img): $rel = 'assets/img/slider/' . basename($img); ?>
            <div class="hero-slide<?= $i === 0 ? ' is-active' : '' ?>" style="background-image:url('<?= e($rel) ?>')"></div>
        <?php endforeach; ?>
    </div>
    <div class="hero-scrim"></div>
    <div class="hero-content container">
        <p class="kicker on-dark">Architectenbureau &middot; sinds 2005</p>
        <h1 class="hero-title">Wij cre&euml;ren<br><em>de juiste</em> omgeving</h1>
        <ul class="hero-diensten">
            <?php foreach (DIENSTEN as $i => $dienst): ?>
                <li><span class="num">0<?= $i + 1 ?></span><?= e($dienst) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <a class="hero-scroll" href="#intro" aria-label="Scroll naar introductie"><span></span></a>
    <div class="hero-count" aria-hidden="true"><span id="heroIndex">01</span> / <?= str_pad((string)count($sliderImages), 2, '0', STR_PAD_LEFT) ?></div>
</section>

<!-- Introductie -->
<section class="section" id="intro">
    <div class="container split">
        <div class="split-label reveal">
            <p class="kicker">01 &mdash; De studio</p>
        </div>
        <div class="split-body reveal">
            <h2 class="display">Ontwerp, engineering en uitvoering, onlosmakelijk verbonden</h2>
            <p class="lead">Studio Vendrig cre&euml;ert voor u de juiste omgeving. Van kleine tot grootschalige
            projecten, van woningbouw tot gezondheidszorg, van aanbouw en verbouw tot nieuwbouw.
            Altijd met knowhow op het gebied van bouwkunst, bouwtechniek en projectmanagement.</p>
            <a class="link-arrow" href="studio.php">Over de studio</a>
        </div>
    </div>
</section>

<!-- Diensten -->
<section class="section section-dark">
    <div class="container">
        <p class="kicker on-dark reveal">02 &mdash; Knowhow</p>
        <div class="diensten-rows">
            <div class="dienst-row reveal">
                <span class="dienst-num">01</span>
                <h3>Bouwkunst</h3>
                <p>Voor het ontwerp: exterieur en interieur, zowel in 2D als in 3D.</p>
            </div>
            <div class="dienst-row reveal">
                <span class="dienst-num">02</span>
                <h3>Bouwtechniek</h3>
                <p>Voor de technische uitwerking, waaronder het digitale tekenwerk.</p>
            </div>
            <div class="dienst-row reveal">
                <span class="dienst-num">03</span>
                <h3>Projectmanagement</h3>
                <p>Het begeleiden van het gehele bouwproject en bouwproces.</p>
            </div>
        </div>
    </div>
</section>

<!-- Uitgelichte projecten -->
<section class="section">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <p class="kicker">03 &mdash; Portfolio</p>
                <h2 class="display">Uitgelichte projecten</h2>
            </div>
            <a class="link-arrow" href="projecten.php">Alle projecten</a>
        </div>
        <div class="project-grid editorial">
            <?php
            $featured = [8, 3, 2, 14, 4, 9];
            foreach ($featured as $n => $fid):
                $p = project_by_id($fid);
                if (!$p || !$p['images']) continue;
            ?>
            <a class="project-card reveal" href="project.php?id=<?= $p['id'] ?>">
                <div class="project-card-img">
                    <img src="<?= e($p['images'][0]['file']) ?>" alt="<?= e($p['title']) ?>" loading="lazy">
                </div>
                <div class="project-card-body">
                    <span class="project-card-cat"><?= e($p['category']) ?></span>
                    <h3><?= e($p['title']) ?></h3>
                    <span class="project-card-num">0<?= $n + 1 ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Nieuws -->
<section class="section section-tint">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <p class="kicker">04 &mdash; Actueel</p>
                <h2 class="display">Recente berichten</h2>
            </div>
            <a class="link-arrow" href="nieuws.php">Al het nieuws</a>
        </div>
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

<!-- Contact-band -->
<section class="cta-band">
    <div class="container center reveal">
        <p class="kicker on-dark">Contact</p>
        <h2 class="display">Een bouwplan of ontwerpvraag?</h2>
        <p class="lead">Van initiatief tot en met de oplevering denken wij graag met u mee.</p>
        <a class="btn" href="contact.php">Neem contact op</a>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
