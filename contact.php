<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Contact';
$bodyClass = 'page-contact';

$sent = false;
$errors = [];
$form = ['naam' => '', 'email' => '', 'telefoon' => '', 'bericht' => ''];

// Bij een statische build (GitHub Pages) is er geen PHP: formulier wordt een e-mailknop.
$isStatic = defined('STATIC_BUILD');

if (!$isStatic && $_SERVER['REQUEST_METHOD'] === 'POST') {
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

<section class="contact-split">
    <aside class="contact-panel">
        <div class="contact-panel-inner">
            <p class="kicker on-dark">Contact</p>
            <h1 class="contact-headline">Laten we<br>kennismaken.</h1>
            <p class="contact-intro">Wij denken graag met u mee, van initiatief tot en met oplevering.</p>

            <div class="contact-lines">
                <a class="contact-line" href="tel:<?= e(str_replace(' ', '', CONTACT['telefoon'])) ?>">
                    <span class="contact-line-label">Telefoon</span>
                    <span class="contact-line-value"><?= e(CONTACT['telefoon']) ?></span>
                </a>
                <a class="contact-line" href="mailto:<?= e(CONTACT['email']) ?>">
                    <span class="contact-line-label">E-mail</span>
                    <span class="contact-line-value"><?= e(CONTACT['email']) ?></span>
                </a>
            </div>

            <div class="contact-meta">
                <div>
                    <span class="contact-line-label">Bezoekadres</span>
                    <p><?= implode('<br>', array_map('e', CONTACT['bezoekadres'])) ?></p>
                </div>
                <div>
                    <span class="contact-line-label">Postadres</span>
                    <p><?= implode('<br>', array_map('e', CONTACT['postadres'])) ?></p>
                </div>
            </div>

            <p><a class="link-arrow on-dark" target="_blank" rel="noopener"
                  href="https://www.google.com/maps/search/?api=1&amp;query=Meidoornkade+22+Houten">Route plannen</a></p>
        </div>
    </aside>

    <div class="contact-form-wrap">
        <div class="contact-form">
            <h2 class="display">Stuur een bericht</h2>
            <?php if ($isStatic): ?>
                <p class="lead">Wij ontvangen uw bericht graag per e-mail of telefoon.</p>
                <p>
                    <a class="btn btn-dark" href="mailto:<?= e(CONTACT['email']) ?>?subject=Contactaanvraag%20via%20studiovendrig.nl">
                        E-mail ons: <?= e(CONTACT['email']) ?>
                    </a>
                </p>
                <p>Of bel <strong><?= e(CONTACT['telefoon']) ?></strong>.</p>
            <?php else: ?>
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
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
