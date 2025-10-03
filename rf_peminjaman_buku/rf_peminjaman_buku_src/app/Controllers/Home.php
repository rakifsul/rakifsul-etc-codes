<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $configModel = model("Config");

        $siteName = $configModel->getValue('SITE_NAME', 'Perpustakaan Online');
        $siteTagline = $configModel->getValue('SITE_TAGLINE', 'Baca buku cepat, mudah, dan terjangkau');

        $data['siteName'] = $siteName;
        $data['siteTagline'] = $siteTagline;

        return view('home', $data);
    }
}
