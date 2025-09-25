<?php

namespace App\Controllers;

use \App\Helpers\G;

class Config extends BaseController
{
    public function index()
    {
        //
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $siteTagline = $configModel->getValue('SITE_TAGLINE', 'Baca buku cepat, mudah, dan terjangkau');
        $adminPagination = $configModel->getValue('ADMIN_PAGINATION', '10');

        //
        $data = [
            'siteName' => $siteName,
            'siteTagline' => $siteTagline,
            'adminPagination' => $adminPagination,
        ];

        return view('admin/config', $data);
    }

    public function processConfig() {
        $configModel = model("Config");

        $siteName = $this->request->getPost('site_name');
        $siteTagline = $this->request->getPost('site_tagline');
        $adminPagination = $this->request->getPost('admin_pagination');

        $configModel->setValue('SITE_NAME', $siteName);
        $configModel->setValue('SITE_TAGLINE', $siteTagline);
        $configModel->setValue('ADMIN_PAGINATION', $adminPagination);

        // G::ddp($siteName);

        return redirect()->to('/config');
    }
}
