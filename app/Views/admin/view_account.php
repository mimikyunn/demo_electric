<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>

<style>
    .account-page {
        max-width: 920px;
        padding: 2.5rem 0 4rem;
    }

    .account-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .account-header h1 {
        margin: 0;
        color: #0b1f3a;
        font-weight: 700;
    }

    .account-header p {
        margin: .35rem 0 0;
        color: #64748b;
    }

    .account-card {
        overflow: hidden;
        border: 1px solid #e5edf5;
        border-radius: 16px;
        box-shadow: 0 10px 24px rgba(11, 31, 58, .06);
    }

    .account-card-header {
        padding: 1.25rem 1.5rem;
        color: white;
        background: linear-gradient(120deg, #123d76, #1479b8);
    }

    .account-card-header h2 {
        margin: 0;
        font-size: 1.2rem;
    }

    .account-card-body {
        padding: 1.5rem;
        background: white;
    }

    .info-group {
        height: 100%;
        padding: 1rem;
        background: #f8fbff;
        border-radius: 10px;
    }

    .info-label {
        margin-bottom: .35rem;
        color: #64748b;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .info-value {
        color: #0b1f3a;
        font-size: 1rem;
    }

    .badge-active {
        color: #166534;
        background: #dcfce7;
    }

    .badge-inactive {
        color: #991b1b;
        background: #fee2e2;
    }

    .badge-suspended {
        color: #92400e;
        background: #fef3c7;
    }

    @media (max-width: 650px) {
        .account-header {
            display: block;
        }

        .account-header .btn {
            margin-top: 1rem;
        }
    }
</style>

<main class="container account-page">
    <div class="account-header">
        <div>
            <h1>Account details</h1>
            <p>Customer account information and service details.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/account/' . $account['id'] . '/edit') ?>" class="btn btn-primary">Edit account</a>
            <a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary">Back to accounts</a>
        </div>
    </div>
    <section class="account-card">
        <div class="account-card-header">
            <h2><?= esc($account['customer_name']) ?></h2>
        </div>
        <div class="account-card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Account number</div>
                        <div class="info-value"><?= esc($account['account_number']) ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Status</div>
                        <div class="info-value"><span class="badge badge-<?= esc($account['status']) ?>"><?= esc(ucfirst($account['status'])) ?></span></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="info-group">
                        <div class="info-label">Address</div>
                        <div class="info-value"><?= esc($account['address']) ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?= esc($account['email']) ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Phone</div>
                        <div class="info-value"><?= esc($account['phone']) ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Meter number</div>
                        <div class="info-value"><?= esc($account['meter_number']) ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Connection type</div>
                        <div class="info-value"><?= esc(ucfirst($account['connection_type'])) ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Created</div>
                        <div class="info-value"><?= esc(date('F j, Y g:i A', strtotime($account['created_at']))) ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Last updated</div>
                        <div class="info-value"><?= esc(date('F j, Y g:i A', strtotime($account['updated_at']))) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form class="mt-3 text-end" action="<?= base_url('admin/account/' . $account['id'] . '/delete') ?>" method="post" onsubmit="return confirm('Delete this customer account?');">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-outline-danger">Delete account</button>
    </form>
</main>

<?= $this->endSection() ?>
