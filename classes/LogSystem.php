<?php
class LogSystem {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Gravar ação do usuário no banco
    public function addLog(string $action, string $details = null, int $user_id = null): bool {
       
        $sql = "INSERT INTO system_log (user_id, action, details, ip_address, created_at) 
                VALUES (:user_id, :action, :details, :ip_address, NOW())";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':user_id', $user_id);
        $sql->bindValue(':action', $action);
        $sql->bindValue(':details', $details);
        $sql->bindValue(':ip_address', $_SERVER['REMOTE_ADDR'] ?? null);
                
        if(!$sql->execute()) {
            return false;
        }
        return true;
    }
}
