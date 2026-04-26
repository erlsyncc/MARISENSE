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

            $this->sendVerificationEmail($user);

            return redirect()->to('/verify-email-pending')->with('email', $this->request->getPost('email'))
                            ->with('message', 'Account created! Please check your email to verify your account.');
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
        $result = auth()->attempt($credentials);
        if ($result->isOK()) {
            $user = auth()->user();
            
            // Check if email is verified
            if (!$this->isEmailVerified($user)) {
                auth()->logout();
                return redirect()->to('/verify-email-pending')->with('email', $credentials['email'])
                                ->with('error', 'Please verify your email before logging in.');
            }
            
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

    // ─────────────────────────────────────────────
    // EMAIL VERIFICATION
    // ─────────────────────────────────────────────

    private function isEmailVerified($user)
    {
        if (!$user) return false;

        $db = \Config\Database::connect();
        $identity = $db->table('auth_identities')
                      ->where('user_id', $user->id)
                      ->where('type', 'email_password')
                      ->get()
                      ->getRowArray();

        if (!$identity) {
            return true;
        }

        if (!$identity['extra']) {
            return true;
        }

        $extra = json_decode($identity['extra'], true) ?? [];
        
        if (!isset($extra['email_verified'])) {
            return true;
        }
        
        return $extra['email_verified'] === true;
    }

    private function sendVerificationEmail($user)
    {
        $db = \Config\Database::connect();
        $identity = $db->table('auth_identities')
                      ->where('user_id', $user->id)
                      ->where('type', 'email_password')
                      ->get()
                      ->getRowArray();

        if (!$identity) return false;

        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', time() + 24 * 3600);

        $extra = json_decode($identity['extra'], true) ?? [];
        $extra['email_verified'] = false;
        $extra['verification_token'] = $token;
        $extra['verification_expires'] = $expires;

        $db->table('auth_identities')
           ->where('id', $identity['id'])
           ->update(['extra' => json_encode($extra)]);

        // Send verification email
        $email = \Config\Services::email();
        $verifyLink = base_url("auth/verify-email/{$token}");

        $message = view('emails/verify_email', [
            'username' => $user->username,
            'verifyLink' => $verifyLink,
        ]);

        $email->setTo($identity['secret'])
              ->setFrom(env('MAIL_FROM_ADDRESS', 'noreply@marisense.local'), 'Waves Water Sports')
              ->setSubject('Verify Your Email Address')
              ->setMessage($message)
              ->send();

        return true;
    }

    public function verifyEmailPending()
    {
        $email = session('email') ?? '';
        return view('verify_email_pending', ['email' => $email]);
    }

    public function verifyEmail($token = '')
    {
        if (!$token) {
            return redirect()->to('/login')->with('error', 'Invalid verification link.');
        }

        $db = \Config\Database::connect();
        $identity = $db->table('auth_identities')
                      ->where('type', 'email_password')
                      ->get()
                      ->getResultArray();

        foreach ($identity as $row) {
            $extra = json_decode($row['extra'], true) ?? [];
            
            if (($extra['verification_token'] ?? '') === $token) {
                $expires = $extra['verification_expires'] ?? '';
                
                if (strtotime($expires) < time()) {
                    return redirect()->to('/verify-email-pending')->with('error', 'Verification link has expired. Request a new one.');
                }

                $extra['email_verified'] = true;
                unset($extra['verification_token']);
                unset($extra['verification_expires']);

                $db->table('auth_identities')
                   ->where('id', $row['id'])
                   ->update(['extra' => json_encode($extra)]);

                return redirect()->to('/login')->with('message', 'Email verified successfully! You can now log in.');
            }
        }

        return redirect()->to('/login')->with('error', 'Invalid verification link.');
    }

    public function resendVerificationEmail()
    {
        $email = $this->request->getPost('email');

        if (!$email) {
            return redirect()->back()->with('error', 'Email is required.');
        }

        $db = \Config\Database::connect();
        $identity = $db->table('auth_identities')
                      ->where('secret', $email)
                      ->where('type', 'email_password')
                      ->get()
                      ->getRowArray();

        if (!$identity) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        $user = auth()->getProvider()->findById($identity['user_id']);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $this->sendVerificationEmail($user);

        return redirect()->to('/verify-email-pending')->with('email', $email)
                        ->with('message', 'Verification email sent! Check your inbox.');
    }
}