<?php
namespace App\Controllers;

use App\Models\MemberModel;

class Member extends BaseController
{
    public function index()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');
        
        //
        $model = new MemberModel();
        $data['members'] = $model->paginate((int)$adminPagination);
        $data['pager'] = $model->pager;
        $data['siteName'] = $siteName;

        return view('admin/member_list', $data);
    }

    public function create()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');
        
        //
        $data['siteName'] = $siteName;
        return view('admin/member_form', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            // 'email' => 'required|valid_email'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new MemberModel();
        
        $last = $model->orderBy('id', 'DESC')->first();
        $newCode = 'M' . str_pad(($last['id'] ?? 0) + 1, 3, '0', STR_PAD_LEFT);

        $model->insert([
            'member_code' => $newCode,
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/member');
    }

    public function edit($id)
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $model = new MemberModel();
        $data['member'] = $model->find($id);

        $data['siteName'] = $siteName;
        
        return view('admin/member_form', $data);
    }

    public function update($id)
    {
        $model = new MemberModel();
        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email')
        ]);
        return redirect()->to('/member');
    }

    public function delete($id)
    {
        $model = new MemberModel();
        $model->delete($id);
        return redirect()->to('/member');
    }
}
