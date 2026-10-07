<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>

<style>
    .form-page { max-width: 900px; padding: 2.5rem 0 4rem; }
    .form-card { border: 1px solid #e5edf5; border-radius: 16px; box-shadow: 0 10px 24px rgba(11,31,58,.06); }
    .form-card-header { padding: 1.5rem; color: white; background: linear-gradient(120deg, #123d76, #1479b8); border-radius: 16px 16px 0 0; }
    .form-card-header h1 { margin: 0; font-size: 1.6rem; }
    .form-card-body { padding: 1.5rem; background: white; border-radius: 0 0 16px 16px; }
    .required::after { color: #dc2626; content: ' *'; }
    .form-actions { display: flex; justify-content: flex-end; gap: .75rem; padding-top: 1.5rem; border-top: 1px solid #e5edf5; }
</style>

<?php
$errors = session()->getFlashdata('errors') ?? [];
$field = static fn (string $name): string => esc(old($name, $account[$name] ?? ''));
?>

<main class="container form-page">
    <div class="form-card">
        <div class="form-card-header"><h1><?= esc($formTitle) ?></h1></div>
        <div class="form-card-body">
            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <strong>Please correct the following:</strong>
                    <ul class="mb-0 mt-2"><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <form action="<?= esc($formAction) ?>" method="post">
                <?= csrf_field() ?>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label required" for="account_number">Account number</label><input class="form-control" id="account_number" name="account_number" value="<?= $field('account_number') ?>" required></div>
                    <div class="col-md-6"><label class="form-label required" for="customer_name">Customer name</label><input class="form-control" id="customer_name" name="customer_name" value="<?= $field('customer_name') ?>" required></div>
                    <div class="col-12"><label class="form-label required" for="address">Address</label><textarea class="form-control" id="address" name="address" rows="2" required><?= $field('address') ?></textarea></div>
                    <div class="col-md-6"><label class="form-label required" for="email">Email</label><input type="email" class="form-control" id="email" name="email" value="<?= $field('email') ?>" required></div>
                    <div class="col-md-6"><label class="form-label required" for="phone">Phone</label><input class="form-control" id="phone" name="phone" value="<?= $field('phone') ?>" required></div>
                    <div class="col-md-6"><label class="form-label required" for="meter_number">Meter number</label><input class="form-control" id="meter_number" name="meter_number" value="<?= $field('meter_number') ?>" required></div>
                    <div class="col-md-3"><label class="form-label required" for="connection_type">Connection type</label><select class="form-select" id="connection_type" name="connection_type" required><option value="">Select type</option><option value="residential" <?= old('connection_type', $account['connection_type'] ?? '') === 'residential' ? 'selected' : '' ?>>Residential</option><option value="commercial" <?= old('connection_type', $account['connection_type'] ?? '') === 'commercial' ? 'selected' : '' ?>>Commercial</option><option value="industrial" <?= old('connection_type', $account['connection_type'] ?? '') === 'industrial' ? 'selected' : '' ?>>Industrial</option></select></div>
                    <div class="col-md-3"><label class="form-label required" for="status">Status</label><select class="form-select" id="status" name="status" required><option value="">Select status</option><option value="active" <?= old('status', $account['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option><option value="inactive" <?= old('status', $account['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option><option value="suspended" <?= old('status', $account['status'] ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option></select></div>
                </div>
                <div class="form-actions mt-4"><a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary">Cancel</a><button type="submit" class="btn btn-primary">Save account</button></div>
            </form>
        </div>
    </div>
</main>

<?= $this->endSection() ?>
