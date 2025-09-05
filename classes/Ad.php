<?php 
class Ad {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function getTotalAds(array $filters): int {
        $total = 0;
        // Preparando filters
        $filterstring = ['1=1']; // Se não tiver nenhum filtro vamos aplicar um 1=1 para não dar erro de sitaxe no WHERE
        if(!empty($filters['category'])) {
            $filterstring[] = 'a.id_categoria = :id_categoria';
        }
        if(!empty($filters['price'])) {
            $filterstring[] = 'a.valor BETWEEN :price1 AND :price2';
        }
        if(!empty($filters['state'])) {
            $filterstring[] = 'a.estado = :state';
        }

        $sql = "SELECT count(*) as total FROM anuncios a WHERE ".implode(' AND ', $filterstring);
        $sql = $this->pdo->prepare($sql);
        
        if(!empty($filters['category'])) {
            $sql->bindValue(':id_categoria', $filters['category']);
        }
        if(!empty($filters['price'])) {
           $price = explode(' - ', $filters['price']);
           $sql->bindValue(':price1', $price[0]);
           $sql->bindValue(':price2', $price[1]);
        }
        if(!empty($filters['state'])) {
            $sql->bindValue(':state', $filters['state']);
        }

        $sql->execute();
        if($sql->rowCount() > 0) {
            $total = $sql->fetch();
            $total = $total['total'];
        }       
        
        return $total;
    }

    public function getLastAds(int $currentPage, int $perPage, array $filters): array {
        $array = array();
        
        $inicio = ($currentPage - 1) * $perPage;

        // Preparando filters
        $filterstring = ['1=1']; // Se não tiver nenhum filtro vamos aplicar um 1=1 para não dar erro de sitaxe no WHERE
        if(!empty($filters['category'])) {
            $filterstring[] = 'a.id_categoria = :id_categoria';
        }
        if(!empty($filters['price'])) {
            $filterstring[] = 'a.valor BETWEEN :price1 AND :price2';
        }
        if(!empty($filters['state'])) {
            $filterstring[] = 'a.estado = :state';
        }
        
        $sql = "SELECT a.*, b.nome AS categoria,
                (SELECT b.url FROM anuncios_imagens b WHERE b.id_anuncio = a.id AND b.foto_principal = 1) AS url        
                FROM anuncios a
                LEFT JOIN categorias b ON (a.id_categoria = b.id) 
                WHERE ". implode(' AND ', $filterstring) ." 
                ORDER BY a.id DESC
                LIMIT $inicio, $perPage"; 
        $sql = $this->pdo->prepare($sql);

        if(!empty($filters['category'])) {
            $sql->bindValue(':id_categoria', $filters['category']);
        }
        if(!empty($filters['price'])) {
           $price = explode(' - ', $filters['price']);
           $sql->bindValue(':price1', $price[0]);
           $sql->bindValue(':price2', $price[1]);
        }
        if(!empty($filters['state'])) {
            $sql->bindValue(':state', $filters['state']);
        }
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
    
    public function getMyAds(int $id_usuario): array {
        
        $array = array();
        $sql = "SELECT *,
                (SELECT b.url FROM anuncios_imagens b WHERE b.id_anuncio = a.id AND b.foto_principal = 1) AS url        
                FROM anuncios a
                WHERE a.id_usuario = :id_usuario"; 
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id_usuario', $id_usuario);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getFullAd(int $id_anuncio): array {
        
        $array = array();

        $array = $this->getAd($id_anuncio);
        $array['fotos'] = $this->getImagesAd($id_anuncio);

        return $array;
    }


    public function getAd(int $id_anuncio): array {
        
        $array = array();

        $sql = "SELECT *, b.nome AS categoria, c.telefone FROM anuncios a 
                LEFT JOIN categorias b ON (a.id_categoria = b.id)
                LEFT JOIN usuarios c ON (a.id_usuario = c.id) 
                WHERE a.id = :id_anuncio";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id_anuncio', $id_anuncio);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    private function getImagesAd(int $id_anuncio): array {
       
        $array = array();

        $sql = "SELECT id, url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id_anuncio', $id_anuncio);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function addAd(string $titulo, int $categoria, float $valor, string $descricao, int $estado, int $usuario): bool {
       
        $sql = "INSERT INTO anuncios (titulo, id_categoria, id_usuario, descricao, valor, estado) 
                VALUES (:titulo, :id_categoria, :id_usuario, :descricao, :valor, :estado)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':id_categoria', $categoria);
        $sql->bindValue(':id_usuario', $usuario);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':estado', $estado);
        
        if(!$sql->execute()) {
            return false;
        }
        return true;
    }

    public function editAd(string $titulo, int $categoria, float $valor, 
                                  string $descricao, int $estado, int $usuario, 
                                  int $id_anuncio, array $fotos): bool {
        
        try {
            $this->pdo->beginTransaction();

            // Atualiza dados do anúncio
            if (!$this->updateAd($titulo, $categoria, $valor, $descricao, $estado, $usuario, $id_anuncio)) {
                $this->pdo->rollBack();
                return false;
            }

            // Adiciona novas imagens, se houver
            if (!empty($fotos) && !$this->addImagesAd($id_anuncio, $fotos)) {
                $this->pdo->rollBack();
                return false;
            }

            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
        
    }

    public function updateAd(string $titulo, int $categoria, float $valor, 
                                     string $descricao, int $estado, int $usuario, 
                                     int $id_anuncio): bool {
        
        $sql = "UPDATE anuncios SET titulo = :titulo, id_categoria = :id_categoria, id_usuario = :id_usuario, 
                descricao = :descricao, valor = :valor, estado = :estado
        WHERE id = :id_anuncio";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':id_categoria', $categoria);
        $sql->bindValue(':id_usuario', $usuario);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':estado', $estado);
        $sql->bindValue(':id_anuncio', $id_anuncio);
        
        if(!$sql->execute()) {
            return false;
        }
        return true;
    }

    public function addImagesAd(int $id_anuncio, array $fotos): bool {
        
        foreach($fotos as $foto_url) {
            $sql = "INSERT INTO anuncios_imagens (id_anuncio, url) VALUES (:id_anuncio, :url)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':id_anuncio', $id_anuncio);
            $sql->bindValue(':url', $foto_url);
            
            if( !$sql->execute() || $this->pdo->lastInsertId() === '0') {
                return false; // falhou algum insert
            }
        }
        return true;                
    }

    
    public function deleteAd(int $id): bool {

        try {
            $this->pdo->beginTransaction();

            // Buscar imagens associadas
            $sql = "SELECT id, url FROM anuncios_imagens WHERE id_anuncio = :id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();
            $imagens = $sql->fetchAll(PDO::FETCH_ASSOC);

            // Excluir arquivos do disco
            foreach ($imagens as $img) {
                if (!$this->deleteImageById($img['id'])) {
                    $this->pdo->rollBack();
                    return false;
                }
            }            

            // Excluir anúncio no banco
            $sql = "DELETE FROM anuncios WHERE id = :id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            // Validação extra: garantir que um anúncio foi excluído
            if ($sql->rowCount() === 0) {
                $this->pdo->rollBack();
                return false;
            }

            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function deleteImageById(int $image_id): bool {
            
            $image = $this->findImageById($image_id);

            if (empty($image)) {                
                return false; // imagem não existe
            }

            $caminho = __DIR__ . "/../assets/images/anuncios/" . basename($image['url']);
            
            // Deletar arquivo físico
            if (file_exists($caminho) && !unlink($caminho)) {               
                return false; // falha ao deletar arquivo
            }

            // Excluir imagem do banco
            $sql = "DELETE FROM anuncios_imagens WHERE id = :id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':id', $image_id);
            $sql->execute();

            // Validar se a linha realmente foi excluída
            if ($sql->rowCount() === 0) {
                return false; // falha ao deletar no banco
            }

            return true;   
    }

    public function findImageById($image_id): array {
        // Buscar imagem associada
        $sql = "SELECT id, url FROM anuncios_imagens WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $image_id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
         

    }

}