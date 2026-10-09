<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="about-hero">
    <div>
        <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> About the project</p>
        <h1>A calmer way to<br><span>meet the day.</span></h1>
        <p class="lede">Tasks for Today turns a simple database into a focused daily workspace—so the next step is always easy to find.</p>
    </div>
    <div class="about-mark" aria-hidden="true">
        <svg viewBox="0 0 180 180"><rect x="24" y="24" width="132" height="132" rx="42"/><path d="m55 91 24 24 49-55"/><path d="M60 45h62M60 136h62"/></svg>
    </div>
</section>

<section class="feature-grid" aria-label="Project highlights">
    <article class="feature-card feature-coral">
        <span class="feature-number">01</span>
        <div class="feature-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 3v3M16 3v3M4.5 9.5h15M6 5h12a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/><path d="m9 15 2 2 4-5"/></svg></div>
        <h2>Daily clarity</h2>
        <p>Today’s work stays separate from the full schedule, keeping attention on what matters now.</p>
    </article>
    <article class="feature-card feature-green">
        <span class="feature-number">02</span>
        <div class="feature-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 18V9M10 18V5M16 18v-6M22 18H2"/></svg></div>
        <h2>Visible progress</h2>
        <p>Status summaries and completion indicators make progress readable at a glance.</p>
    </article>
    <article class="feature-card feature-gold">
        <span class="feature-number">03</span>
        <div class="feature-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 20V8h8v12M8 12h8"/></svg></div>
        <h2>Responsive by design</h2>
        <p>The desktop table becomes clear, touch-friendly cards on smaller screens.</p>
    </article>
</section>

<section class="about-details">
    <article class="card project-card">
        <div class="card-head">
            <div><p class="section-kicker">Project details</p><h2>Made for the web</h2></div>
            <span class="card-head-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 9 5 12l3 3M16 9l3 3-3 3M14 6l-4 12"/></svg></span>
        </div>
        <dl class="details">
            <div><dt>Developer</dt><dd><?= esc($developer) ?></dd></div>
            <div><dt>Course</dt><dd><?= esc($course) ?></dd></div>
            <div><dt>Architecture</dt><dd>Model · View · Controller</dd></div>
        </dl>
    </article>

    <article class="card stack-card">
        <p class="section-kicker">Technology</p>
        <h2>Simple, dependable tools</h2>
        <p>Server-rendered pages keep the project approachable while a relational database keeps task data organized.</p>
        <div class="stack-list" aria-label="Technology stack">
            <span>PHP 8.2</span><span>CodeIgniter 4</span><span>MySQL</span><span>HTML5</span><span>Custom CSS</span>
        </div>
    </article>
</section>

<?= $this->endSection() ?>
