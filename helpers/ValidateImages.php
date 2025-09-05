<?php 
class ValidateImages {

    public static function validateImgs($fotos, $dir): array {
        $caminho = realpath(__DIR__ . '/../assets/images/anuncios/') . DIRECTORY_SEPARATOR;
       
        $arrayFotos = array();

        if(count($fotos) > 0) {

            for($i=0;$i<count($fotos['name']);$i++) {
                $tipo = $fotos['type'][$i];

                if(in_array($tipo, array('image/jpeg', 'image/png'))) {
                    $tmpname = md5(time().rand(0,9999)).'.jpg'; // Novo nome do arquivo

                    move_uploaded_file( $fotos['tmp_name'][$i], $caminho.$tmpname );

                    // Convertendo a imagem
                    list( $width_original, $height_original) = getimagesize( $caminho.$tmpname );

                    $ratio = $width_original/$height_original;

                    $width = 500;
                    $height = 500;

                    if($width/$height > $ratio) {
                        $width = $height*$ratio;
                    } else {
                        $height = $width/$ratio;
                    }

                    $img = imagecreatetruecolor( $width, $height );
                    if( $tipo == 'image/jpeg' ) {
                        $orignal = imagecreatefromjpeg( $caminho.$tmpname);
                    } elseif( $tipo == 'image/png' ) {
                        $orignal = imagecreatefrompng( $caminho.$tmpname);
                    }

                    imagecopyresampled($img, $orignal, 0, 0, 0, 0, $width, $height, $width_original, $height_original);

                    imagejpeg($img, $caminho.$tmpname, 80);// qualidade 80 é o padrão, boa e com tamanho bom

                    $arrayFotos[] = $tmpname;


                }
            }
        }

        return $arrayFotos;

    }
}