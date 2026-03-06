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

    // Logic para sa pag-save ng bagong account
    public function registerAuth()
    {
        // 1. Validation Rules
        $rules = [
            'username'         => 'required|is_unique[users.username]|min_length[3]',
            'email'            => 'required|valid_email|is_unique[auth_identities.secret]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Get the User Provider (Shield)
        $users = auth()->getProvider();

        // 3. Create the User Entity
        $user = new User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        // 4. Save to Database
        try {
            $users->save($user);

            // Kunin ang actual user object na na-save na may ID na
            $user = $users->findById($users->getInsertID());

            if ($user) {
                $user->addGroup('user'); // Dito dapat 'user' ang ilalagay
            }

            return redirect()->to('/login')->with('message', 'Account created!');
        } catch (\Exception $e) {
            // Para makita mo ang error kahit hindi naka-debug mode:
            die($e->getMessage()); 
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