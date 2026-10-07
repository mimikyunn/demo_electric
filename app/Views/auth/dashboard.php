<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>

<?php $displayName = trim((string) ($username ?? '')) ?: 'Customer'; ?>
<style>
    .dashboard-page { padding: 2.5rem 0 4rem; }
    .welcome { padding: clamp(2rem, 5vw, 3.5rem); color: white; border-radius: 22px; background: linear-gradient(120deg, #123d76, #1479b8); box-shadow: 0 18px 40px rgba(11,31,58,.14); }
    .welcome small { color: #bae6fd; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
    .welcome h1 { margin: .6rem 0 .75rem; font: 700 clamp(2rem, 5vw, 3.6rem)/1.05 'Space Grotesk', sans-serif; letter-spacing: -.06em; }
    .welcome p { max-width: 560px; margin: 0; color: #e0f2fe; font-size: 1.05rem; line-height: 1.65; }
    .dashboard-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.2rem; margin-top: 1.3rem; }
    .dashboard-card { padding: 1.5rem; background: white; border: 1px solid #e4edf6; border-radius: 16px; box-shadow: 0 8px 22px rgba(11,31,58,.05); }
    .dashboard-card i { display: grid; place-items: center; width: 2.7rem; height: 2.7rem; margin-bottom: 1rem; color: #2563eb; background: #eff6ff; border-radius: 10px; }
    .dashboard-card h2 { margin: 0 0 .4rem; font: 700 1.05rem 'Space Grotesk', sans-serif; }
    .dashboard-card p { margin: 0; color: #64748b; font-size: .9rem; line-height: 1.55; }
    @media (max-width: 700px) { .dashboard-cards { grid-template-columns: 1fr; } .dashboard-page { width: min(100% - 1.5rem, 1100px); } }
</style>

<main class="container dashboard-page">
    <section class="welcome">
        <small>Customer dashboard</small>
        <h1>Welcome, <?= esc($displayName) ?>!</h1>
        <p>Your account is active and ready. From here, you can stay connected with Puihaha Electric and manage your service needs.</p>
    </section>

    <section class="dashboard-cards" aria-label="Dashboard options">
        <article class="dashboard-card"><h2>Account overview</h2><p>Review your customer details and account information.</p></article>
        <article class="dashboard-card"><h2>Need assistance?</h2><p>Our team is ready to help with questions about your electric service.</p></article>
        <article class="dashboard-card"><h2>Secure access</h2><p>Your session is protected. Log out when you finish using your account.</p></article>
    </section>
</main>

<?= $this->endSection() ?>
