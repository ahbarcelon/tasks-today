<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<header class="page-head page-head-split">
    <div>
        <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> Full schedule</p>
        <h1>Your complete plan.</h1>
        <p class="lede">See what’s finished, what’s moving, and what needs attention next.</p>
    </div>
    <a class="button button-quiet head-action" href="<?= site_url('/') ?>">Back to today <span aria-hidden="true">→</span></a>
</header>

<?php if (empty($tasks)): ?>
    <section class="card empty-state">
        <div class="empty-illustration" aria-hidden="true">
            <svg viewBox="0 0 120 120"><circle cx="60" cy="60" r="45"/><path d="M38 62h44M42 48h36M46 76h27"/><path d="m77 78 7 7 15-18"/></svg>
        </div>
        <p class="eyebrow">Ready when you are</p>
        <h2>No tasks yet</h2>
        <p>The task list is empty. Run <code>php spark db:seed TasksTodaySeeder</code> to load the sample schedule.</p>
    </section>
<?php else: ?>
    <?= $this->include('partials/summary') ?>
    <?php
    $caption = 'All tasks ordered by date';
    $listTitle = 'All tasks';
    $listDescription = count($tasks) . ' items ordered by due date.';
    ?>
    <?= $this->include('partials/task_table') ?>
<?php endif; ?>

<?= $this->endSection() ?>
