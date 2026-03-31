<?php

namespace App\Controllers;

use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class Auth extends BaseController
{
    public function login()
    {
        // Kung logged in na, huwag nang ipakita ang login page, redirect agad sa dashboard
        if (auth()->loggedIn()) {
            return $this->redirectUserBasedOnGroup();
        }
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerAuth()
    {
        $rules = [
            'username' => 'required|is_unique[users.username]|min_length[3]',
            'email'    => 'required|valid_email|is_unique[auth_identities.secret]', 
            'password' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $users = auth()->getProvider();

        $user = new User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        try {
            $users->save($user);
            $user = $users->findById($users->getInsertID());
            $user->addGroup('user'); // Default group

            return redirect()->to('/login')->with('message', 'Account created successfully! You can now log in.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['db' => 'Registration failed.']);
        }
    }

    public function loginAuth()
    {
        // FIX: Siguraduhin na walang lumang session para maiwasan ang LogicException
        if (auth()->loggedIn()) {
            auth()->logout();
        }

        $credentials = [
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        // Attempt login
        if (auth()->attempt($credentials)->isOK()) {
            return $this->redirectUserBasedOnGroup();
        } else {
            return redirect()->to('/login')->with('error', 'Invalid Email or Password');
        }
    }

    // Helper function para hindi paulit-ulit ang redirect logic
    private function redirectUserBasedOnGroup()
    {
        $user = auth()->user();
        if ($user->inGroup('admin')) {
            return redirect()->to('/admin/dashboard');
        } 
        return redirect()->to('/user/home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/login')->with('message', 'Logged out successfully.');
    }
}