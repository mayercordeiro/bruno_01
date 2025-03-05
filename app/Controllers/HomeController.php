<?php

namespace App\Controllers;

use Src\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Gestão Inteligente - Home',
        ];

        $this->render('home', $data);
    }
}
