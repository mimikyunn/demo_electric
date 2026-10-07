<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>

<style>
    .admin-page {
        padding: 2.5rem 0 4rem;
    }

    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .page-heading h1 {
        margin: 0;
        color: #0b1f3a;
        font-weight: 700;
    }

    .page-heading p {
        margin: .35rem 0 0;
        color: #64748b;
    }

    .stat-card {
        height: 100%;
        padding: 1.25rem;
        color: white;
        border: 0;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(11, 31, 58, .1);
    }

    .stat-card h2 {
        margin: 0;
        font-size: 1.9rem;
    }

    .stat-card p {
        margin: .25rem 0 0;
        opacity: .9;
    }

    .stat-total {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .stat-active {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    .stat-inactive {
        background: linear-gradient(135deg, #e11d48, #f97316);
    }

    .stat-suspended {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }

    .filter-card,
    .table-card {
        border: 1px solid #e5edf5;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(11, 31, 58, .04);
    }

    .filter-card {
        padding: 1.25rem;
        background: #f8fbff;
    }

    .table-card {
        overflow: hidden;
        background: white;
    }

    .table-card .table {
        margin: 0;
    }

    .table-card th {
        white-space: nowrap;
        color: #475569;
        font-size: .8rem;
        letter-spacing: .04em;
        text-transform: uppercase;
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

    .pagination {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        margin: 0;
    }

    .pagination li {
        list-style: none;
    }

    .pagination li a {
        display: grid;
        min-width: 2.25rem;
        height: 2.25rem;
        place-items: center;
        padding: 0 .7rem;
        color: #475569;
        border: 1px solid #dbe5f0;
        border-radius: 8px;
        background: #fff;
        font-size: .85rem;
        text-decoration: none;
        transition: all .2s ease;
    }

    .pagination li a:hover {
        color: #1e40af;
        border-color: #93c5fd;
        background: #eff6ff;
    }

    .pagination li.active a {
        color: #fff;
        border-color: #1e40af;
        background: #1e40af;
        font-weight: 700;
    }

    @media (max-width: 650px) {
        .table-card > .d-flex {
            justify-content: center !important;
        }

        .table-card > .d-flex small {
            width: 100%;
            text-align: center;
        }
    }

    @media (max-width: 650px) {
        .page-heading {
            display: block;
        }

        .page-heading .btn {
            margin-top: 1rem;
        }
    }
</style>

<main class="container admin-page">
    <div class="page-heading">
        <div>
            <h1>Customer accounts</h1>
            <p>Review account status and customer information.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin') ?>" class="btn btn-outline-primary">Refresh</a>
            <a href="<?= base_url('admin/account/new') ?>" class="btn btn-primary">Add customer</a>
        </div>
    </div>
    <?php if ($error = session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>
    <?php if ($success = session()->getFlashdata('success')): ?><div class="alert alert-success"><?= esc($success) ?></div><?php endif; ?>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-total">
                <h2><?= esc($total_accounts) ?></h2>
                <p>Total accounts</p>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-active">
                <h2><?= esc($active_accounts) ?></h2>
                <p>Active accounts</p>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-inactive">
                <h2><?= esc($inactive_accounts) ?></h2>
                <p>Inactive accounts</p>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-suspended">
                <h2><?= esc($suspended_accounts) ?></h2>
                <p>Suspended accounts</p>
            </div>
        </div>
    </div>

    <div class="filter-card mb-4">
        <form method="get" action="<?= base_url('admin') ?>" class="row g-3 align-items-end">
            <div class="col-lg-5"><label class="form-label" for="search">Search accounts</label><input class="form-control" id="search" name="search" value="<?= esc($search_keyword ?? '') ?>" placeholder="Name, account, email, phone"></div>
            <div class="col-md-4 col-lg-2"><label class="form-label" for="status">Status</label><select class="form-select" id="status" name="status">
                    <option value="">All statuses</option>
                    <option value="active" <?= ($filter_status ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($filter_status ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    <option value="suspended" <?= ($filter_status ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
                </select></div>
            <div class="col-md-4 col-lg-3"><label class="form-label" for="type">Connection type</label><select class="form-select" id="type" name="type">
                    <option value="">All types</option>
                    <option value="residential" <?= ($filter_type ?? '') === 'residential' ? 'selected' : '' ?>>Residential</option>
                    <option value="commercial" <?= ($filter_type ?? '') === 'commercial' ? 'selected' : '' ?>>Commercial</option>
                    <option value="industrial" <?= ($filter_type ?? '') === 'industrial' ? 'selected' : '' ?>>Industrial</option>
                </select></div>
            <div class="col-md-4 col-lg-2"><button class="btn btn-primary w-100" type="submit">Filter</button></div>
        </form>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($accounts)): ?><tr>
                            <td colspan="6" class="py-5 text-center text-muted">No customer accounts found.</td>
                        </tr>
                        <?php else: foreach ($accounts as $account): ?><tr>
                                <td><strong><?= esc($account['account_number']) ?></strong></td>
                                <td><?= esc($account['customer_name']) ?></td>
                                <td><?= esc($account['email']) ?></td>
                                <td><?= esc(ucfirst($account['connection_type'])) ?></td>
                                <td><span class="badge badge-<?= esc($account['status']) ?>"><?= esc(ucfirst($account['status'])) ?></span></td>
                                <td class="text-end"><a class="btn btn-sm btn-outline-primary" href="<?= base_url('admin/account/' . $account['id']) ?>">View</a><a class="btn btn-sm btn-outline-secondary ms-1" href="<?= base_url('admin/account/' . $account['id'] . '/edit') ?>">Edit</a></td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div><?php if ($pager): ?><div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-3 border-top"><small class="text-muted">Page <?= esc($current_page) ?> of <?= esc($pager->getPageCount()) ?></small><?= $pager->links() ?></div><?php endif; ?>
    </div>
</main>

<?= $this->endSection() ?>
