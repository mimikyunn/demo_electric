<?php
$error = session()->getFlashdata('error');
$success = session()->getFlashdata('success');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal | Puihaha Electric</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0b1f3a;
            --blue: #2563eb;
            --muted: #64748b;
            --line: #dbe5f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--navy);
            background: #f5f9ff;
            font-family: 'DM Sans', sans-serif;
        }

        .login-shell {
            display: grid;
            grid-template-columns: minmax(320px, .95fr) minmax(420px, 1.05fr);
            min-height: 100vh;
        }

        .brand-panel {
            position: relative;
            overflow: hidden;
            padding: clamp(2rem, 6vw, 6rem);
            color: white;
            background: linear-gradient(145deg, #07182f 0%, #123d76 58%, #1479b8 100%);
        }

        .brand-content {
            position: relative;
            z-index: 1;
            max-width: 480px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            font: 700 1.35rem 'Space Grotesk', sans-serif;
            letter-spacing: -.03em;
        }


        .eyebrow {
            margin: 0 0 1rem;
            color: #7dd3fc;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .brand-copy h1 {
            max-width: 500px;
            margin: 0;
            font: 700 clamp(2.5rem, 5vw, 4.7rem)/.98 'Space Grotesk', sans-serif;
            letter-spacing: -.07em;
        }

        .brand-copy p {
            max-width: 400px;
            margin: 1.5rem 0 0;
            color: #cfe5f8;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .feature-list {
            display: grid;
            gap: .9rem;
            margin: 2rem 0 0;
            color: #dbeafe;
            font-size: .92rem;
        }

        .feature-list span {
            display: flex;
            align-items: center;
            gap: .7rem;
        }

        .feature-list i {
            color: #fbbf24;
        }

        .form-panel {
            display: grid;
            place-items: center;
            padding: 2rem;
            background: #fff;
        }

        .login-card {
            width: min(100%, 430px);
        }

        .form-heading h2 {
            margin: 0;
            font: 700 2rem 'Space Grotesk', sans-serif;
            letter-spacing: -.04em;
        }

        .form-heading p {
            margin: .6rem 0 0;
            color: var(--muted);
        }

        .alert {
            display: flex;
            gap: .65rem;
            align-items: flex-start;
            margin: 1.5rem 0;
            padding: .85rem 1rem;
            border-radius: 12px;
            font-size: .9rem;
        }

        .alert-danger {
            color: #991b1b;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .alert-success {
            color: #166534;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        form {
            margin-top: 2rem;
        }

        label {
            display: block;
            margin: 0 0 .45rem;
            font-size: .88rem;
            font-weight: 700;
        }

        .input-wrap {
            position: relative;
            margin-bottom: 1.2rem;
        }


        input {
            width: 100%;
            padding: .95rem 1rem;
            color: var(--navy);
            background: #f8fbff;
            border: 1px solid var(--line);
            border-radius: 12px;
            outline: none;
            font: inherit;
            transition: .2s ease;
        }

        input:focus {
            background: white;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        button {
            width: 100%;
            margin-top: .35rem;
            padding: 1rem;
            color: white;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(100deg, var(--blue), #0ea5e9);
            cursor: pointer;
            font: 700 1rem 'DM Sans', sans-serif;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .2);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(37, 99, 235, .28);
        }

        .helper {
            margin: 1.3rem 0 0;
            color: var(--muted);
            text-align: center;
            font-size: .88rem;
        }

        .helper a {
            color: var(--blue);
            font-weight: 700;
            text-decoration: none;
        }

        .security-note {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: .45rem;
            margin-top: 2.5rem;
            color: #94a3b8;
            font-size: .78rem;
        }

        @media (max-width: 780px) {
            .login-shell {
                display: block;
            }

            .brand-panel {
                min-height: 300px;
                padding: 2rem;
            }

            .brand-content {
                gap: 3rem;
            }

            .brand-copy h1 {
                font-size: 2.7rem;
            }

            .brand-copy p,
            .feature-list {
                display: none;
            }

            .form-panel {
                padding: 3rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <main class="login-shell">
        <section class="brand-panel" aria-label="Puihaha Electric employee portal">
            <div class="brand-content">
                <div class="brand">Puihaha Electric</div>
                <div class="brand-copy">
                    <p class="eyebrow">Employee portal</p>
                    <h1>Welcome to your work hub.</h1>
                    <p>Sign in to access your employee dashboard and the tools you need to keep Puihaha Electric running.</p>
                    <div class="feature-list">
                        <span>Secure employee access</span>
                        <span>Everything you need, in one place</span>
                    </div>
                </div>
                <small>© <?= date('Y') ?> Puihaha Electric Company</small>
            </div>
        </section>
        <section class="form-panel">
            <div class="login-card">
                <div class="form-heading">
                    <h2>Employee sign in</h2>
                    <p>Use your company email address to continue.</p>
                </div>
                <?php if ($error): ?><div class="alert alert-danger" role="alert"><span><?= esc($error) ?></span></div><?php endif; ?>
                <?php if ($success): ?><div class="alert alert-success" role="status"><span><?= esc($success) ?></span></div><?php endif; ?>
                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <label for="email">Email address</label>
                    <div class="input-wrap"><input type="email" name="email" id="email" value="<?= esc(old('email')) ?>" autocomplete="email" placeholder="you@example.com" required autofocus></div>
                    <label for="password">Password</label>
                    <div class="input-wrap"><input type="password" name="password" id="password" autocomplete="current-password" placeholder="Enter your password" required></div>
                    <button type="submit">Sign in securely</button>
                </form>
                <p class="helper">Having trouble signing in? Contact your administrator.</p>
                <div class="security-note">Your information is protected</div>
            </div>
        </section>
    </main>
</body>

</html>
