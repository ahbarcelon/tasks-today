<?php
/** @var array $tasks */
$todayKey = date('Y-m-d');
$totalTasks = count($tasks);
$doneTasks = count(array_filter($tasks, static fn (array $task): bool => $task['status'] === 'completed'));
$listProgress = $totalTasks > 0 ? (int) round(($doneTasks / $totalTasks) * 100) : 0;
$isTodayList = trim(uri_string(), '/') === '';
$resolvedListTitle = $isTodayList ? 'Today’s focus' : 'All tasks';
$resolvedDescription = $isTodayList
    ? ($totalTasks === 1 ? '1 task is on your list.' : $totalTasks . ' tasks are on your list.')
    : $totalTasks . ' items ordered by due date.';
$resolvedCaption = $isTodayList ? 'Tasks scheduled for today' : 'All tasks ordered by date';
?>
<section id="task-list" class="task-section" aria-labelledby="task-list-title">
    <header class="list-head">
        <div>
            <p class="section-kicker">Task list</p>
            <h2 id="task-list-title"><?= esc($resolvedListTitle) ?></h2>
            <p><?= esc($resolvedDescription) ?></p>
        </div>
        <div class="list-progress" aria-label="<?= $listProgress ?> percent complete">
            <span><strong><?= $doneTasks ?></strong>/<?= $totalTasks ?> done</span>
            <div class="progress-track"><span style="width: <?= $listProgress ?>%"></span></div>
        </div>
    </header>

    <div class="card table-card">
        <table class="task-table">
            <caption class="visually-hidden"><?= esc($resolvedCaption) ?></caption>
            <thead>
                <tr>
                    <th scope="col">Task</th>
                    <th scope="col">Progress</th>
                    <th scope="col">Due</th>
                    <th scope="col">Added</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $index => $task): ?>
                <?php
                $slug = str_replace(' ', '-', $task['status']);
                $taskTimestamp = strtotime($task['task_date']);
                $todayTimestamp = strtotime($todayKey);
                $dayDifference = (int) round(($taskTimestamp - $todayTimestamp) / 86400);

                if ($dayDifference === 0) {
                    $dateContext = 'Today';
                    $dateClass = 'is-today';
                } elseif ($dayDifference === 1) {
                    $dateContext = 'Tomorrow';
                    $dateClass = 'is-upcoming';
                } elseif ($dayDifference === -1) {
                    $dateContext = 'Yesterday';
                    $dateClass = 'is-overdue';
                } elseif ($dayDifference < 0) {
                    $dateContext = abs($dayDifference) . ' days ago';
                    $dateClass = 'is-overdue';
                } else {
                    $dateContext = 'In ' . $dayDifference . ' days';
                    $dateClass = 'is-upcoming';
                }
                ?>
                <tr>
                    <th scope="row" class="task-title">
                        <span class="task-number" aria-hidden="true"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                        <span><?= esc($task['title']) ?></span>
                    </th>
                    <td data-label="Progress">
                        <span class="badge badge-<?= esc($slug, 'attr') ?>"><span aria-hidden="true"></span><?= esc(ucwords($task['status'])) ?></span>
                    </td>
                    <td data-label="Due">
                        <div class="date-stack">
                            <time datetime="<?= esc($task['task_date'], 'attr') ?>"><?= date('M j, Y', $taskTimestamp) ?></time>
                            <span class="date-context <?= esc($dateClass, 'attr') ?>"><?= esc($dateContext) ?></span>
                        </div>
                    </td>
                    <td data-label="Added">
                        <div class="date-stack date-created">
                            <time datetime="<?= esc($task['created_at'], 'attr') ?>"><?= date('M j, Y', strtotime($task['created_at'])) ?></time>
                            <span><?= date('g:i A', strtotime($task['created_at'])) ?></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
