<?php

namespace App\Controllers;

use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    // Pakitang register form
    public function register()
        {
            return view('register');
        }

        public function registerAuth()
        {
            // Idagdag ang validation para hindi mag-duplicate ang email sa DB
            $rules = [
                'username' => 'required|is_unique[users.username]|min_length[3]',
                'email'    => 'required|valid_email|is_unique[auth_identities.secret]', 
                'password' => 'required|min_length[8]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $users = auth()->getProvider();

            $user = new \CodeIgniter\Shield\Entities\User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);

            try {
                $users->save($user);
                $user = $users->findById($users->getInsertID());
                $user->addGroup('user');

                return redirect()->to('/login')->with('message', 'Account created successfully! You can now log in.');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('errors', ['db' => 'Registration failed. Please try again.']);
            }
        }
            


    public function loginAuth()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Gamitin na natin ang Shield para mag-login sa database
        $credentials = [
            'email'    => $email,
            'password' => $password
        ];

        if (auth()->attempt($credentials)->isOK()) {
            return redirect()->to('/');
        } else {
            $session->setFlashdata('error', 'Invalid Email or Password');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }
}