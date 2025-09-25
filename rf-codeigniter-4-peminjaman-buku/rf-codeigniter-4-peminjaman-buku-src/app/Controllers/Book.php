<?php
namespace App\Controllers;

use App\Models\BookModel;

class Book extends BaseController
{
    public function index()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $model = new BookModel();
        $data['books'] = $model->paginate((int)$adminPagination);
        $data['pager'] = $model->pager;
        
        $data['siteName'] = $siteName;
        
        return view('admin/book_list', $data);
    }

    public function create()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $data['siteName'] = $siteName;
        return view('admin/book_form', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|numeric',
            'fine_unit' => 'required|numeric',
            'cover' => 'required|uploaded[cover]|max_size[cover,2048]|is_image[cover]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $cover = $this->request->getFile('cover');
        $coverName = $cover->getRandomName();
        $cover->move('uploads', $coverName);

        $model = new BookModel();
        $model->insert([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'category' => $this->request->getPost('category'),
            'year' => $this->request->getPost('year'),
            'fine_unit' => $this->request->getPost('fine_unit'),
            'cover' => $coverName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/book');
    }

    public function edit($id)
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $model = new BookModel();
        $data['book'] = $model->find($id);

        $data['siteName'] = $siteName;

        return view('admin/book_form', $data);
    }

    public function update($id)
    {
        $model = new BookModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'category' => $this->request->getPost('category'),
            'year' => $this->request->getPost('year'),
            'fine_unit' => $this->request->getPost('fine_unit')
        ];

        if ($this->request->getFile('cover')->isValid()) {
            $cover = $this->request->getFile('cover');
            $coverName = $cover->getRandomName();
            $cover->move('uploads', $coverName);
            $data['cover'] = $coverName;
        }

        $model->update($id, $data);
        return redirect()->to('/book');
    }

    public function delete($id)
    {
        $model = new BookModel();
        $model->delete($id);
        return redirect()->to('/book');
    }
}
