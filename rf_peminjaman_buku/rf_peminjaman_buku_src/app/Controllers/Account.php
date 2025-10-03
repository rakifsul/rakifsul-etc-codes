<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class Account extends BaseController
{
    public function index()
    {
        //
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        // $title = "$siteName - Account";

        $userModel = model("UserModel");

        $pair = session()->get();
        // G::ddp($pair);

        $account = $userModel->where('id', $pair['user_id'])->first();

        $data = [
            'siteName' => $siteName,
            'username' => $account['username'],
        ];
        return view('admin/account', $data);
    }

    public function do_apply_account() {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required|min_length[4]',
            'passwordRepeat' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // G::ddp("done");

        $request = \Config\Services::request();
        $pair = session()->get();
        
        $username = $request->getPost('username');
        $password = $request->getPost('password');
        
        $userModel = model("UserModel");
        $userModel->update(
            $pair['user_id'], 
            [
                'username' => $username, 
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

        return redirect()->to('/account');
    }
}
