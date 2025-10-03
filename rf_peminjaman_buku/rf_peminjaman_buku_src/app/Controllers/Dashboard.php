<?php
namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\BookModel;
use App\Models\LoanModel;

use \App\Helpers\G;

class Dashboard extends BaseController
{
    public function index()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $info = G::getSystemInfo();
        
        //
        $memberModel = new MemberModel();
        $bookModel = new BookModel();
        $loanModel = new LoanModel();

        $data = [
            'totalMembers' => $memberModel->countAllResults(),
            'totalBooks' => $bookModel->countAllResults(),
            'activeLoans' => $loanModel->where('return_date', null)->countAllResults(),
        ];

        $data['siteName'] = $siteName;
        $data['info'] = $info;

        return view('admin/dashboard', $data);
    }
}
