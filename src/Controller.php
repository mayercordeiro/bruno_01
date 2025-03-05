<?php

namespace Src;

class Controller
{
    public function render($view, $data = [])
    {
        extract($data);  // Extrai os dados para serem acessados na view

        // Inclui o arquivo da view
        include __DIR__ . '/../app/Views/' . $view . '.php';
    }
}
