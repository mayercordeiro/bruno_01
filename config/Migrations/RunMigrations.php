<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Config\Migration;

echo "Iniciando Migrações...\n";

Migration::run();

echo "Migrações executadas com sucesso!\n";
