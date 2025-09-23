<?php 

class FormatImages {

    public static function format(string $tmp, string $name, string $type, string $uploadPath, $height = 500, $width = 500): array {
        // Possíveis resultados
        $result = [
            'success' => null, 
            'error' => null
        ];

        $diretorio = __DIR__ . '/../assets/images/'.$uploadPath;

        // Normaliza caminho para upload das imagens
        $caminho = rtrim($diretorio, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        // Gerando nome único para as imagens
        $tmpname = Validator::generateFilename($name);

        // Realizado upload e retornando o erro caso não seja possível
        if (!move_uploaded_file($tmp, $caminho . $tmpname)) {
            $result['error'] = "Falha ao mover o arquivo <b>$name</b>.";
            return $result;
            exit;
        }

        /*
        * Define o tamanho alvo como 500x500, mas mantendo a proporção original.
        *
        * Ou seja, se a imagem não é quadrada, ela será ajustada proporcionalmente dentro de 500x500.
        *
        * imagecreatetruecolor cria uma imagem em branco com o tamanho final. 
        */
        list($width_original, $height_original) = getimagesize($caminho . $tmpname);
        $ratio = $width_original / $height_original;

        // Definindo as dimensões 
        if ($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }
        
        $img = imagecreatetruecolor($width, $height);

        // convertendo o formato da imagem
        if ($type == 'image/jpeg') {
            $original = imagecreatefromjpeg($caminho . $tmpname);
        } elseif ($type == 'image/png') {
            $original = imagecreatefrompng($caminho . $tmpname);
        }

        // Copia e redimensiona a imagem original para o novo tamanho ($width x $height).
        imagecopyresampled($img, $original, 0, 0, 0, 0, $width, $height, $width_original, $height_original);

        /*
        * Salva como JPEG (mesmo que fosse PNG originalmente, no caso do seu código).
        *
        * 80 é a qualidade (1 a 100).
        *
        * Isso reduz o tamanho do arquivo e mantém boa qualidade.
        *
        */
        imagejpeg($img, $caminho . $tmpname, 80);

        // Retornando a imagem
        $result['success'] = $tmpname;
        return $result;
    }
}


/*
* Como usar
* FormatImages::format($_FILES['photos']['tmp_name'][$i],
    $_FILES['photos']['name'][$i],
    $_FILES['photos']['type'][$i],
    __DIR__ . '/../assets/images/banners/',500,500)
*/