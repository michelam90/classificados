<?php
class MessagesSystem {
    public static function message(string $type, string $context = ''): string {
        $messages = [
            // Sistema
            'denied_method' => "Requisição inválida. Método não permitido.",
            'denied_csrf'   => "Requisição negada por falha de segurança (CSRF).",

            // Formulário
            'required'      => "O campo <b>{$context}</b> é obrigatório.",
            'invalid'       => "O campo <b>{$context}</b> é inválido.",
            'minlength'     => "O campo <b>{$context}</b> ultrapassou tamanho máximo.",
            'format'        => "O campo <b>{$context}</b> possui formato incorreto.",

            // Upload
            'upload_size'   => "O arquivo <b>{$context}</b> excede o limite permitido de 2MB.",
            'upload_type'   => "O arquivo <b>{$context}</b> possui tipo não permitido (somente JPEG e PNG).",

            // CRUD
            'create_success' => "Cadastro realizado com sucesso!",
            'update_success' => "Atualização realizada com sucesso!",
            'create_fail'    => "Não foi possível realizar o cadastro.",
            'update_fail'    => "Não foi possível realizar a atualização.",
        ];

       
        $alert = self::typeAlert($type);


        $messageText = $messages[$type] ?? "Erro desconhecido: {$type}";

        return <<<HTML
        <div class="alert alert-{$alert} alert-dismissible fade show" role="alert">
            {$messageText}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        HTML;
    }

    private static function typeAlert(string $type): string {

        if (
            strpos($type, 'create_') === 0 ||
            strpos($type, 'update_') === 0 ||
            strpos($type, 'delete_') === 0 ||
            $type === 'login'
        ) {

            $alert = 'success';

        } elseif (
            strpos($type, 'denied') === 0 ||
            strpos($type, 'upload_') === 0
        ) {

            $alert = 'danger';

        } else {

            $alert = 'warning';

        }
        
        return $alert;

    }

}

