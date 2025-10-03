<?php
namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\MemberModel;
use App\Models\BookModel;

class Loan extends BaseController
{
    public function index()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $model = new LoanModel();

        //
        $model->select('loans.*, members.name as member_name, books.title as book_title')
            ->join('members', 'members.id = loans.member_id')
            ->join('books', 'books.id = loans.book_id');

        $data['loans'] = $model->paginate((int)$adminPagination); // 10 per halaman
        $data['pager'] = $model->pager;
        $data['siteName'] = $siteName;

        // Join loans with members and books for display
        // $builder = $model->builder();
        // $builder->select('loans.*, members.name as member_name, books.title as book_title');
        // $builder->join('members', 'members.id = loans.member_id');
        // $builder->join('books', 'books.id = loans.book_id');
        // $data['loans'] = $builder->get()->getResultArray();

        return view('admin/loan_list', $data);
    }

    public function create()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $memberModel = new MemberModel();
        $bookModel = new BookModel();

        $data['members'] = $memberModel->findAll();
        $data['books'] = $bookModel->findAll();

        $data['siteName'] = $siteName;

        return view('admin/loan_form', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'member_id' => 'required|integer',
            'book_id' => 'required|integer',
            'loan_date' => 'required|valid_date',
            'due_date' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $loanModel = new LoanModel();

        // Cek apakah buku sedang dipinjam dan belum dikembalikan
        $existingLoan = $loanModel->where('book_id', $this->request->getPost('book_id'))
                                  ->where('return_date', null)
                                  ->first();

        if ($existingLoan) {
            session()->setFlashdata('error', 'Buku ini sedang dipinjam dan belum dikembalikan.');
            return redirect()->back()->withInput();
        }

        $loanModel->insert([
            'member_id' => $this->request->getPost('member_id'),
            'book_id' => $this->request->getPost('book_id'),
            'loan_date' => $this->request->getPost('loan_date'),
            'due_date' => $this->request->getPost('due_date'),
            'return_date' => null,
            'fine' => 0
        ]);

        return redirect()->to('/loan');
    }

    public function edit($id)
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $loanModel = new LoanModel();
        $loan = $loanModel->find($id);

        if (!$loan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $memberModel = new MemberModel();
        $bookModel = new BookModel();

        $data['loan'] = $loan;
        $data['members'] = $memberModel->findAll();
        $data['books'] = $bookModel->findAll();

        $data['siteName'] = $siteName;

        return view('admin/loan_form', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'member_id' => 'required|integer',
            'book_id' => 'required|integer',
            'loan_date' => 'required|valid_date',
            'due_date' => 'required|valid_date',
            'return_date' => 'permit_empty|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $loanModel = new LoanModel();
        $bookModel = new BookModel();

        $returnDate = $this->request->getPost('return_date');
        $fine = 0;
        if ($returnDate) {
            $book = $bookModel->where('id', $this->request->getPost('book_id'))->first();
            $dueDate = strtotime($this->request->getPost('due_date'));
            $retDate = strtotime($returnDate);
            $lateDays = max(0, ($retDate - $dueDate) / 86400);
            $fine = $lateDays * $book['fine_unit']; // misal denda 1000 per hari
        }

        $loanModel->update($id, [
            'member_id' => $this->request->getPost('member_id'),
            'book_id' => $this->request->getPost('book_id'),
            'loan_date' => $this->request->getPost('loan_date'),
            'due_date' => $this->request->getPost('due_date'),
            'return_date' => $returnDate ?: null,
            'fine' => $fine
        ]);

        return redirect()->to('/loan');
    }

    public function delete($id)
    {
        $loanModel = new LoanModel();
        $loanModel->delete($id);
        return redirect()->to('/loan');
    }
}
