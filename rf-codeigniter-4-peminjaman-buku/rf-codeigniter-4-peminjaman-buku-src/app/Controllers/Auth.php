<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        $data['siteName'] = $siteName;

        return view('auth/login', $data);
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function register()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');
        
        $data['siteName'] = $siteName;

        return view('auth/register', $data);
    }

    public function processRegister()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $password_repeat = $this->request->getPost('password_repeat');

        $err = "";
        $regSuccess = true;

        if(!$username)
        {
            $err .= "username empty.<br>";
            $regSuccess = false;
        }

        if(!$password)
        {
            $err .= "password empty.<br>";
            $regSuccess = false;
        }

        if($password != $password_repeat)
        {
            $err .= "password doesn't match.<br>";
            $regSuccess = false;
        }

        if($regSuccess == false) {
            session()->setFlashdata("error", $err);
            return redirect()->to('/register');
        }

        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'fullname' => 'Administrator',
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $userModel->insert($data);

        return redirect()->to('/login');
    }
}
