<?php
helper('url');

$path  = trim(uri_string(), '/');
$links = [
    ''        => 'Today',
    'tasks'   => 'All tasks',
    'profile' => 'Profile',
    'about'   => 'About',
];
$icons = [
    ''        => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 3v3M16 3v3M4.5 9.5h15M6 5h12a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/><path d="m9 15 2 2 4-5"/></svg>',
    'tasks'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6h11M9 12h11M9 18h11"/><path d="m4 6 1 1 2-2M4 12l1 1 2-2M4 18l1 1 2-2"/></svg>',
    'profile' => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4.5 21a7.5 7.5 0 0 1 15 0"/></svg>',
    'about'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 11v6M12 7.5v.01"/></svg>',
];
$routeLabel = $links[$path] ?? 'Tasks for Today';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#173f35">
    <meta name="description" content="A calm, focused dashboard for tracking today's tasks and the week ahead.">
    <title><?= esc($title ?? 'Tasks for Today') ?> | Tasks for Today</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="route-<?= esc($path === '' ? 'today' : $path, 'attr') ?>">
    <a class="skip-link" href="#main">Skip to content</a>

    <div class="app-shell">
        <aside class="sidebar">
            <div class="sidebar-main">
                <a class="brand" href="<?= site_url('/') ?>" aria-label="Tasks for Today home">
                    <span class="brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 28 28"><rect x="3" y="3" width="22" height="22" rx="7"/><path d="m9 14 3.2 3.2L19 10.5"/></svg>
                    </span>
                    <span class="brand-copy"><strong>Tasks</strong><small>for today</small></span>
                </a>

                <p class="nav-caption">Workspace</p>
                <nav aria-label="Main navigation">
                    <ul class="nav-list">
                        <?php foreach ($links as $slug => $label): ?>
                            <li>
                                <a href="<?= site_url($slug) ?>"
                                   class="nav-link<?= $path === $slug ? ' is-active' : '' ?>"
                                   <?= $path === $slug ? 'aria-current="page"' : '' ?>>
                                    <span class="nav-icon"><?= $icons[$slug] ?></span>
                                    <span><?= esc($label) ?></span>
                                    <?php if ($path === $slug): ?><span class="active-pip" aria-hidden="true"></span><?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>

            <div class="sidebar-note">
                <span class="note-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 3a6 6 0 0 0-3.6 10.8c.8.6 1.1 1.2 1.1 2.2h5c0-1 .3-1.6 1.1-2.2A6 6 0 0 0 12 3Z"/><path d="M9.5 19h5M10.5 22h3"/></svg>
                </span>
                <div><strong>Small steps count.</strong><span>Pick one task and start there.</span></div>
            </div>
        </aside>

        <div class="main-shell">
            <header class="topbar">
                <div>
                    <span class="topbar-label">Workspace</span>
                    <strong><?= esc($routeLabel) ?></strong>
                </div>
                <div class="date-chip">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 3v3M16 3v3M4.5 9.5h15M6 5h12a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/></svg>
                    <time datetime="<?= date('Y-m-d') ?>"><?= date('D, M j') ?></time>
                </div>
            </header>

            <main id="main" class="page">
                <?= $this->renderSection('content') ?>
            </main>

            <footer class="site-footer">
                <span>Tasks for Today</span>
                <span class="footer-dot" aria-hidden="true"></span>
                <span>Built with CodeIgniter 4</span>
            </footer>
        </div>
    </div>
</body>
</html>
