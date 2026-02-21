<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function loginAuth()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // TEMPORARY LOGIN (Replace later with DB)
        if ($email == "admin@gmail.com" && $password == "123456") {

            $session->set([
                'email' => $email,
                'logged_in' => true
            ]);

            return redirect()->to('/');
        } else {
            $session->setFlashdata('error', 'Invalid Email or Password');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}