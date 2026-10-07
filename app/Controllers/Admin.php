<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;
class Admin extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    /**
     * Display dashboard with customer accounts list (paginated)
     */
    public function index()
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        // Get search keyword if exists
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $type = $this->request->getGet('type');

        // Items per page
        $perPage = 10;

        // Get paginated data based on filters
        if ($keyword) {
            $accounts = $this->customerModel->searchAccounts($keyword, $perPage);
        } elseif ($status) {
            $accounts = $this->customerModel->getAccountsByStatus($status, $perPage);
        } elseif ($type) {
            $accounts = $this->customerModel->getAccountsByType($type, $perPage);
        } else {
            $accounts = $this->customerModel->getAccountsPaginated($perPage);
        }

        // Get statistics
        $data = [
            'title' => 'Customer Accounts | Puihaha Electric',
            'page' => 'accounts',
            'accounts' => $accounts,
            'pager' => $this->customerModel->pager,
            'total_accounts' => $this->customerModel->getTotalAccounts(),
            'active_accounts' => $this->customerModel->getCountByStatus('active'),
            'inactive_accounts' => $this->customerModel->getCountByStatus('inactive'),
            'suspended_accounts' => $this->customerModel->getCountByStatus('suspended'),
            'current_page' => $this->request->getGet('page') ?? 1,
            'search_keyword' => $keyword,
            'filter_status' => $status,
            'filter_type' => $type
        ];

        return view('admin/cust_accs', $data);
    }

    /**
     * View single account details
     */
    public function viewAccount($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to('/admin')->with('error', 'Account not found');
        }

        $data = [
            'title' => 'Account Details | Puihaha Electric',
            'page' => 'accounts',
            'account' => $account
        ];

        return view('admin/view_account', $data);
    }

    public function newAccount()
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        return view('admin/account_form', [
            'title' => 'New Customer Account | Puihaha Electric',
            'page' => 'accounts',
            'formAction' => base_url('admin/account'),
            'formTitle' => 'Add customer account',
            'account' => [],
        ]);
    }

    public function createAccount()
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        if (! $this->validate($this->accountRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->customerModel->insert($this->accountData()) === false) {
            return redirect()->back()->withInput()->with('errors', $this->saveErrors());
        }

        return redirect()->to('/admin')->with('success', 'Customer account created successfully.');
    }

    public function editAccount($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $account = $this->customerModel->find($id);
        if (! $account) {
            return redirect()->to('/admin')->with('error', 'Account not found.');
        }

        return view('admin/account_form', [
            'title' => 'Edit Customer Account | Puihaha Electric',
            'page' => 'accounts',
            'formAction' => base_url('admin/account/' . $id),
            'formTitle' => 'Edit customer account',
            'account' => $account,
        ]);
    }

    public function updateAccount($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        if (! $this->customerModel->find($id)) {
            return redirect()->to('/admin')->with('error', 'Account not found.');
        }

        if (! $this->validate($this->accountRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->customerModel->update($id, $this->accountData()) === false) {
            return redirect()->back()->withInput()->with('errors', $this->saveErrors());
        }

        return redirect()->to('/admin/account/' . $id)->with('success', 'Customer account updated successfully.');
    }

    public function deleteAccount($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        if (! $this->customerModel->find($id)) {
            return redirect()->to('/admin')->with('error', 'Account not found.');
        }

        $this->customerModel->delete($id);

        return redirect()->to('/admin')->with('success', 'Customer account deleted successfully.');
    }

    private function requireLogin()
    {
        if (session()->get('isLogged') !== true) {
            return redirect()->to('/login')->with('error', 'Please sign in to access the admin area.');
        }

        return null;
    }

    private function accountRules(): array
    {
        return [
            'account_number' => 'required|max_length[50]',
            'customer_name' => 'required|max_length[150]',
            'address' => 'required|max_length[255]',
            'phone' => 'required|max_length[20]',
            'email' => 'required|valid_email|max_length[100]',
            'meter_number' => 'required|max_length[50]',
            'connection_type' => 'required|in_list[residential,commercial,industrial]',
            'status' => 'required|in_list[active,inactive,suspended]',
        ];
    }

    private function accountData(): array
    {
        return [
            'account_number' => trim((string) $this->request->getPost('account_number')),
            'customer_name' => trim((string) $this->request->getPost('customer_name')),
            'address' => trim((string) $this->request->getPost('address')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'email' => trim((string) $this->request->getPost('email')),
            'meter_number' => trim((string) $this->request->getPost('meter_number')),
            'connection_type' => $this->request->getPost('connection_type'),
            'status' => $this->request->getPost('status'),
        ];
    }

    private function saveErrors(): array
    {
        $errors = $this->customerModel->errors();

        if ($errors) {
            return $errors;
        }

        log_message('error', 'Customer account save failed: {message}', [
            'message' => db_connect()->error()['message'] ?? 'Unknown database error',
        ]);

        return ['database' => 'The customer account could not be saved. Check the account number and try again.'];
    }
}
