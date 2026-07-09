<?php require_once __DIR__ . '/functions.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Architectenbureau Studio Vendrig: Bouwkunst, Bouwtechniek en Projectmanagement. Wij creëren de juiste omgeving.">
    <title><?= isset($pageTitle) && $pageTitle ? e($pageTitle) . ' | ' : '' ?>Architectenbureau <?= SITE_NAME ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
</head>
<body class="<?= isset($bodyClass) ? e($bodyClass) : '' ?>">

<header class="site-header" id="siteHeader">
    <div class="header-inner">
        <a class="brand" href="index.php">
            <span class="brand-text">
                <span class="brand-name logo-word">Studio <em>Vendrig</em></span>
                <span class="brand-sub">architectuur &amp; bouwtechniek</span>
            </span>
        </a>
        <nav class="main-nav" id="mainNav" aria-label="Hoofdnavigatie">
            <ul>
                <?php foreach (NAV as $file => $label): ?>
                    <li><a href="<?= $file ?>" class="<?= is_active($file) ? 'active' : '' ?>"><?= e($label) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <button class="nav-toggle" id="navToggle" aria-label="Menu openen" aria-expanded="false">
            <span></span><span></span>
        </button>
    </div>
</header>

<main>
