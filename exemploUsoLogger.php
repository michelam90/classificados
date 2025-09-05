<?php
require __DIR__ . '/config.php';

// Ação do usuário
$actionsLogger->info("Usuário 123 logou no sistema");

// SQL com erro
try {
    $pdo->query("SELECT * FROM tabela_inexistente");
} catch (PDOException $e) {
    $sqlLogger->error("Erro SQL: " . $e->getMessage());
}

// Notice de PHP (será registrado automaticamente)
echo $_GET['nao_existe'];
