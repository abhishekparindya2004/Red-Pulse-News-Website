<?php

function render_header(string $page, string $title): void
{
    $nav = [
        'home' => ['label' => 'Home', 'href' => 'index.php'],
        'world' => ['label' => 'World', 'href' => 'world.php'],
        'technology' => ['label' => 'Technology', 'href' => 'technology.php'],
        'sports' => ['label' => 'Sports', 'href' => 'sports.php'],
        'contact' => ['label' => 'Contact', 'href' => 'contact.php'],
        'admin' => ['label' => 'Admin', 'href' => 'admin.php'],
    ];

    ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="icon" href="images/logo.png">
  <link rel="stylesheet" href="style.css">
</head>
<body data-page="<?= htmlspecialchars($page) ?>">
<div class="topbar">
  <div class="wrap">
    <div class="left">
      <span class="badge"><span class="dot"></span> LIVE</span>
      <span>Breaking updates • Fast • Verified</span>
    </div>
  </div>
</div>
<header class="site-header">
  <div class="wrap">
    <div class="brand">
      <div class="logo-icon">RP</div>
      <div>
        <div class="logo-text">RedPulse</div>
      </div>
    </div>

    <nav class="nav" aria-label="Primary">
      <?php foreach ($nav as $key => $item): ?>
        <a class="<?= $page === $key ? 'active' : '' ?>" href="<?= $item['href'] ?>"><?= $item['label'] ?></a>
      <?php endforeach; ?>
    </nav>
  </div>
</header>
<?php
}

function render_footer(): void
{
    ?>
<footer>
  <div class="wrap">
    <div>
      <h4>About RedPulse</h4>
      <p>Global news and marketplace demo.</p>
    </div>
    <div>
      <h4>Sections</h4>
      <p>Home • World • Technology • Sports • Contact</p>
    </div>
    <div>
      <h4>Contact</h4>
      <p>newsroom@redpulse.com</p>
    </div>
  </div>
  <div class="bottom">
    <span>© 2026 RedPulse PVT & LTD</span>
  </div>
</footer>
<script src="app.js"></script>
</body>
</html>
<?php
}
