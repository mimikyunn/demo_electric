<?php

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    
  
    public function login()
    {
        if (session()->get('isLogged') === true) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'email' => 'required|valid_email|max_length[255]',
                'password' => 'required|max_length[255]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Enter a valid email address and password.');
            }

            $credentials = $this->request->getPost(['email', 'password']);
            $user = (new User())->findByEmail($credentials['email']);

            // New accounts should store passwords with password_hash(). The second
            // condition keeps existing classroom databases with plaintext passwords working.
            $validPassword = $user !== null
                && (password_verify($credentials['password'], $user['password'])
                    || hash_equals((string) $user['password'], (string) $credentials['password']));

            if (! $validPassword || (array_key_exists('is_active', $user) && ! $user['is_active'])) {
                return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
            }

            session()->regenerate();
            session()->set([
                'isLogged' => true,
                'user_id'  => $user['id'],
                'username' => trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?: $user['email'],
            ]);

            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function dashboard()
    {
        if (session()->get('isLogged') !== true) {
            return redirect()->to('/login');
        }

        return view('auth/dashboard', [
            'title' => 'Dashboard | Puihaha Electric',
            'page' => 'dashboard',
            'username' => session()->get('username'),
        ]);
    }

    public function logout()
    {
        if (session()->get('isLogged') !== true) {
            return redirect()->to('/login');
        }

        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }


    
}
