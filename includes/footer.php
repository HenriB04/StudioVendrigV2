</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-top">
            <p class="footer-tagline">&lsquo;<?= SITE_TAGLINE ?>&rsquo;</p>
            <img src="assets/img/logo.png" alt="Studio Vendrig logo" class="footer-logo">
        </div>
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Bezoekadres</h3>
                <p><?= implode('<br>', array_map('e', CONTACT['bezoekadres'])) ?></p>
                <h3>Postadres</h3>
                <p><?= implode('<br>', array_map('e', CONTACT['postadres'])) ?></p>
            </div>
            <div class="footer-col">
                <h3>Contact</h3>
                <p>
                    <strong>T</strong> <?= e(CONTACT['telefoon']) ?><br>
                    <strong>F</strong> <?= e(CONTACT['fax']) ?><br>
                    <strong>E</strong> <a href="mailto:<?= e(CONTACT['email']) ?>"><?= e(CONTACT['email']) ?></a><br>
                    <strong>W</strong> <?= e(CONTACT['website']) ?>
                </p>
            </div>
            <div class="footer-col">
                <h3>Diensten</h3>
                <ul class="footer-list">
                    <?php foreach (DIENSTEN as $i => $dienst): ?>
                        <li><span class="num">0<?= $i + 1 ?></span> <?= e($dienst) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Navigatie</h3>
                <ul class="footer-list footer-nav">
                    <?php foreach (NAV as $file => $label): ?>
                        <li><a href="<?= $file ?>"><?= e($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Architectenbureau <?= SITE_NAME ?> &middot; Meidoornkade 22, 3992 AE Houten</p>
        </div>
    </div>
</footer>

<div class="lightbox" id="lightbox" hidden>
    <button class="lightbox-close" aria-label="Sluiten">&times;</button>
    <button class="lightbox-prev" aria-label="Vorige">&#8249;</button>
    <img src="" alt="">
    <button class="lightbox-next" aria-label="Volgende">&#8250;</button>
    <p class="lightbox-caption"></p>
</div>

<script src="assets/js/main.js"></script>
</body>
</html>
