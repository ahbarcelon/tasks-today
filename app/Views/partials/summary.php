<?php
/** @var array $counts */
$summaryTotal = array_sum($counts);
$summaryItems = [
    'pending' => [
        'label' => 'Waiting',
        'note' => 'Ready to begin',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M12 8v4l2.5 2"/></svg>',
    ],
    'in progress' => [
        'label' => 'In motion',
        'note' => 'Currently active',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5.5A8 8 0 1 1 5 8"/><path d="M4 4v4h4M12 8v4l3 1.5"/></svg>',
    ],
    'completed' => [
        'label' => 'Completed',
        'note' => 'Nicely done',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="m8.5 12 2.3 2.3 4.8-5"/></svg>',
    ],
];
?>
<section class="summary" aria-label="Task summary">
    <?php foreach ($summaryItems as $key => $item): ?>
        <?php $share = $summaryTotal > 0 ? (int) round(($counts[$key] / $summaryTotal) * 100) : 0; ?>
        <article class="stat stat-<?= esc(str_replace(' ', '-', $key), 'attr') ?>">
            <div class="stat-top">
                <span class="stat-icon"><?= $item['icon'] ?></span>
                <span class="stat-share"><?= $share ?>%</span>
            </div>
            <div class="stat-value-row">
                <strong class="stat-value"><?= (int) $counts[$key] ?></strong>
                <div><span class="stat-label"><?= esc($item['label']) ?></span><small><?= esc($item['note']) ?></small></div>
            </div>
            <div class="stat-track" aria-hidden="true"><span style="width: <?= $share ?>%"></span></div>
        </article>
    <?php endforeach; ?>
</section>
