<?php

// Pegando os dados de acesso
$ini = parse_ini_file('bd.ini');

$host = $ini['host'];
$name = $ini['name'];
$user = $ini['user'];
$pass = $ini['pass'];
if ($pass === false) $pass = ''; // força string vazia se não encontrar

try {
    $pdo = new PDO("mysql:dbname=$name;host=$host", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Erros como exceção
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

} catch(PDOException $e) {
     // Carrega o logger
    $logger = require __DIR__ . '/logger.php';
    $logger->error("Falha ao conectar no banco", ['erro' => $e->getMessage()]);
    die("Erro de conexão com o banco");
    exit();
}


function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception(".env file not found: " . $path);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) {
            continue; // ignora comentários
        }

        list($name, $value) = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        // Remove aspas se existirem
        $value = trim($value, '"\''); 

        // Seta no ambiente
        putenv("$name=$value");
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}
