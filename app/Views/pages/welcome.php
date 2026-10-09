<?php
$hour = (int) date('G');
$greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
$total = count($tasks ?? []);
$completed = (int) ($counts['completed'] ?? 0);
$progress = $total > 0 ? (int) round(($completed / $total) * 100) : 0;
?>
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero hero-today" aria-labelledby="page-title">
    <div class="hero-copy">
        <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> Daily focus</p>
        <h1 id="page-title"><?= esc($greeting) ?>.<br><span>Here’s your day.</span></h1>
        <p class="lede"><time datetime="<?= date('Y-m-d') ?>"><?= esc($today) ?></time></p>
        <div class="hero-actions">
            <a class="button button-primary" href="#task-list">Start your day <span aria-hidden="true">↓</span></a>
            <a class="button button-quiet" href="<?= site_url('tasks') ?>">View full schedule <span aria-hidden="true">→</span></a>
        </div>
    </div>
    <div class="focus-meter" aria-label="<?= $progress ?> percent of today's tasks completed">
        <div class="meter-ring" style="--progress: <?= $progress ?>">
            <div><strong><?= $progress ?>%</strong><span>complete</span></div>
        </div>
        <p><strong><?= $completed ?> of <?= $total ?></strong> tasks wrapped up</p>
        <span>Keep the momentum going.</span>
    </div>
</section>

<?php if (empty($tasks)): ?>
    <section class="card empty-state">
        <div class="empty-illustration" aria-hidden="true">
            <svg viewBox="0 0 120 120"><circle cx="60" cy="60" r="45"/><path d="M38 62h44M42 48h36M46 76h27"/><path d="m77 78 7 7 15-18"/></svg>
        </div>
        <p class="eyebrow">A clear day</p>
        <h2>Nothing scheduled for today</h2>
        <p>No tasks share today’s date. Take a breather or look ahead at the rest of your schedule.</p>
        <a class="button button-primary" href="<?= site_url('tasks') ?>">Browse all tasks <span aria-hidden="true">→</span></a>
    </section>
<?php else: ?>
    <?= $this->include('partials/summary') ?>
    <?php
    $caption = 'Tasks scheduled for today';
    $listTitle = 'Today’s focus';
    $listDescription = $total === 1 ? '1 task is on your list.' : $total . ' tasks are on your list.';
    ?>
    <?= $this->include('partials/task_table') ?>
<?php endif; ?>

<?= $this->endSection() ?>
