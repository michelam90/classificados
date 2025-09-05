<?php
class User {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findByToken($token): array {
        $sql = "SELECT * FROM usuarios WHERE token = :token";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return [];
    }    

    public function updateToken($email, $token): bool {

        $sql = "UPDATE usuarios SET token = :token WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':token', $token);
        
        if($sql->execute()) {
            return true;
        }
        return false;
    } 

    public function findbyEmail($email): array {
       
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return [];
    }

    public function getTotalUsers(): int {
        $total = 0;

        $sql = "SELECT count(*) as total FROM usuarios";
        $sql = $this->pdo->query($sql);
        $total = $sql->fetch();
        $total = $total['total'];
        
        return $total;
    }

    public function registerUser(string $nome, string $email, string $senha, string $telefone): bool {
       
        if( $this->emailExists($email) == false ) {
           $sql = "INSERT INTO usuarios (nome, email, senha, telefone) VALUES 
            (:nome, :email, :senha, :telefone)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", password_hash($senha, PASSWORD_DEFAULT));
            $sql->bindValue(":telefone", $telefone);
            
            if(!$sql->execute()) {
                return false;
            }
            return true;
        }

        return false;        
    }

    private function emailExists($email): bool {
       
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        }
        return false;
    }


    public function findById($id): array {
        
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {             
            return $sql->fetch();
        }
        return array();
    }
    
}