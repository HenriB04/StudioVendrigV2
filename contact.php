<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Contact';

$sent = false;
$errors = [];
$form = ['naam' => '', 'email' => '', 'telefoon' => '', 'bericht' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($form as $key => $_) {
        $form[$key] = trim($_POST[$key] ?? '');
    }
    if ($form['naam'] === '') {
        $errors['naam'] = 'Vul uw naam in.';
    }
    if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Vul een geldig e-mailadres in.';
    }
    if ($form['bericht'] === '') {
        $errors['bericht'] = 'Vul een bericht in.';
    }

    if (!$errors) {
        // Lokaal (zonder mailserver) wordt het bericht in een logbestand bewaard.
        $log = sprintf(
            "[%s] Van: %s <%s> Tel: %s\n%s\n%s\n",
            date('Y-m-d H:i:s'), $form['naam'], $form['email'], $form['telefoon'],
            $form['bericht'], str_repeat('-', 60)
        );
        @file_put_contents(__DIR__ . '/berichten.log', $log, FILE_APPEND);
        @mail(CONTACT['email'], 'Contactformulier studiovendrig.nl van ' . $form['naam'], $form['bericht'], 'From: ' . $form['email']);
        $sent = true;
        $form = ['naam' => '', 'email' => '', 'telefoon' => '', 'bericht' => ''];
    }
}

require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <p class="kicker">Contact</p>
        <h1 class="display-xl">Neem contact op</h1>
        <p class="lead">Wij denken graag met u mee, van initiatief tot en met oplevering.</p>
    </div>
</section>

<section class="section">
    <div class="container contact-layout">
        <div class="contact-info">
            <h2 class="display">Gegevens</h2>
            <h3>Bezoekadres</h3>
            <p><?= implode('<br>', array_map('e', CONTACT['bezoekadres'])) ?></p>
            <h3>Postadres</h3>
            <p><?= implode('<br>', array_map('e', CONTACT['postadres'])) ?></p>
            <h3>Bereikbaarheid</h3>
            <p>
                <strong>T</strong> <?= e(CONTACT['telefoon']) ?><br>
                <strong>F</strong> <?= e(CONTACT['fax']) ?><br>
                <strong>E</strong> <a href="mailto:<?= e(CONTACT['email']) ?>"><?= e(CONTACT['email']) ?></a><br>
                <strong>W</strong> <?= e(CONTACT['website']) ?>
            </p>
            <h3>Diensten</h3>
            <ul class="footer-list">
                <?php foreach (DIENSTEN as $i => $dienst): ?>
                    <li><span class="num">0<?= $i + 1 ?></span> <?= e($dienst) ?></li>
                <?php endforeach; ?>
            </ul>
            <p>
                <a class="link-arrow" target="_blank" rel="noopener"
                   href="https://www.google.com/maps/search/?api=1&amp;query=Meidoornkade+22+Houten">
                   Route plannen
                </a>
            </p>
        </div>

        <div class="contact-form">
            <h2 class="display">Stuur een bericht</h2>
            <?php if ($sent): ?>
                <div class="form-success">
                    <p><strong>Bedankt voor uw bericht!</strong> Wij nemen zo spoedig mogelijk contact met u op.</p>
                </div>
            <?php endif; ?>
            <form method="post" action="contact.php" novalidate>
                <div class="form-field">
                    <label for="naam">Naam *</label>
                    <input type="text" id="naam" name="naam" value="<?= e($form['naam']) ?>" required>
                    <?php if (isset($errors['naam'])): ?><span class="form-error"><?= e($errors['naam']) ?></span><?php endif; ?>
                </div>
                <div class="form-field">
                    <label for="email">E-mailadres *</label>
                    <input type="email" id="email" name="email" value="<?= e($form['email']) ?>" required>
                    <?php if (isset($errors['email'])): ?><span class="form-error"><?= e($errors['email']) ?></span><?php endif; ?>
                </div>
                <div class="form-field">
                    <label for="telefoon">Telefoonnummer</label>
                    <input type="tel" id="telefoon" name="telefoon" value="<?= e($form['telefoon']) ?>">
                </div>
                <div class="form-field">
                    <label for="bericht">Bericht *</label>
                    <textarea id="bericht" name="bericht" rows="6" required><?= e($form['bericht']) ?></textarea>
                    <?php if (isset($errors['bericht'])): ?><span class="form-error"><?= e($errors['bericht']) ?></span><?php endif; ?>
                </div>
                <button type="submit" class="btn btn-dark">Verstuur bericht</button>
            </form>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
