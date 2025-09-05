<?php
class AdCategory {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
       
        $array = array();

        $sql = "SELECT * FROM categorias";
        $sql = $this->pdo->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}