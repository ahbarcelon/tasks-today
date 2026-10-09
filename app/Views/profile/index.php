<?php
$initials = '';
if (! empty($user['full_name'])) {
    foreach (preg_split('/\s+/', trim($user['full_name'])) as $namePart) {
        $initials .= mb_substr($namePart, 0, 1);
    }
    $initials = mb_strtoupper(mb_substr($initials, 0, 2));
}
?>
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<header class="page-head">
    <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> Your space</p>
    <h1>Profile &amp; account.</h1>
    <p class="lede">The person behind the plan, all in one place.</p>
</header>

<?php if (empty($user)): ?>
    <section class="card empty-state">
        <div class="empty-illustration" aria-hidden="true">
            <svg viewBox="0 0 120 120"><circle cx="60" cy="46" r="19"/><path d="M26 96c3-20 17-30 34-30s31 10 34 30"/></svg>
        </div>
        <h2>No user found</h2>
        <p>The users table is empty. Run <code>php spark db:seed TasksTodaySeeder</code> to add the demo user.</p>
    </section>
<?php else: ?>
    <section class="profile-grid">
        <article class="card profile-identity">
            <div class="profile-wash" aria-hidden="true"></div>
            <div class="avatar"><?= esc($initials) ?></div>
            <div class="identity-copy">
                <span class="account-pill"><span aria-hidden="true"></span> Active account</span>
                <h2><?= esc($user['full_name']) ?></h2>
                <p>@<?= esc($user['username']) ?></p>
            </div>
            <div class="identity-note">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a9 9 0 1 0 9 9"/><path d="M12 7v5l3 2M17 4l2 2 3-3"/></svg>
                <span><strong>Ready to focus</strong>Your task dashboard is up to date.</span>
            </div>
        </article>

        <article class="card profile-details" aria-labelledby="account-details-title">
            <div class="card-head">
                <div><p class="section-kicker">Account</p><h2 id="account-details-title">Personal details</h2></div>
                <span class="card-head-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2.8 2.8-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6v.2h-4V21a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1L4.2 17l.1-.1a1.7 1.7 0 0 0 .3-1.9A1.7 1.7 0 0 0 3 14H2.8v-4H3a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L4.2 7 7 4.2l.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6v-.2h4V3a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1L19.8 7l-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1h.2v4H21a1.7 1.7 0 0 0-1.6 1Z"/></svg></span>
            </div>
            <dl class="details">
                <div><dt>Username</dt><dd><?= esc($user['username']) ?></dd></div>
                <div><dt>Full name</dt><dd><?= esc($user['full_name']) ?></dd></div>
                <div><dt>Email address</dt><dd><a href="mailto:<?= esc($user['email'], 'attr') ?>"><?= esc($user['email']) ?></a></dd></div>
                <div><dt>Member since</dt><dd><time datetime="<?= esc($user['created_at'], 'attr') ?>"><?= date('F j, Y', strtotime($user['created_at'])) ?></time></dd></div>
            </dl>
        </article>
    </section>
<?php endif; ?>

<?= $this->endSection() ?>
