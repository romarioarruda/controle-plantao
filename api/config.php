<?php

try {
    global $pdo;

    $pdo = new PDO('mysql:dbname=plantao;host=localhost;charset=utf8', 'root', '');

}catch(Throwable $err) {
    echo 'Erro de conexão.';
}