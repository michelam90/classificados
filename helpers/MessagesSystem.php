<?php
class MessagesSystem {
    public static function message($type, $field ='', $extra=''): string {
        
        $messages = [
            // Validações de formulário
            'required'  => "O campo <b>{$field}</b> é obrigatório.",
            'invalid'   => "O campo <b>{$field}</b> é inválido. ".$extra,
            'minlength' => "O campo <b>{$field}</b> ultrapassou tamanho máximo.",
            'format'    => "O campo <b>{$field}</b> possui formato incorreto.",
            'denied'   => "Requisição inválida. ".$field,

            // Operações de cadastro/atualização
            'create_success' => "Cadastro realizado com sucesso!",
            'update_success' => "Atualização realizada com sucesso!",
            'create_fail'    => "Não foi possível realizar o cadastro.",
            'update_fail'    => "Não foi possível realizar a atualização.",
            'delete_success' => "Registro excluído com sucesso. <b>$field</b>",
            'delete_fail'    => "Não foi possível excluir. <b>$field</b>",
            'already_exists' => "Cadastro já existe.",
            'login'          => "Faça login"
        ];

        if($type == 'required' || $type == 'format' || $type == 'minlength' || $type == 'invalid') {
            $alert = 'warning';
        } elseif($type == 'create_fail' || $type == 'update_fail' || $type == 'delete_fail' || $type == 'denied' || $type == 'already_exists') {
            $alert = 'danger';
        } elseif($type == 'create_success' || $type == 'update_success' || $type == 'delete_success' || $type == 'login') {
            $alert = 'success';
        }


        $message = '<div class="alert alert-'.$alert.' alert-dismissible fade show" role="alert">
                             '.$messages[$type].'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';

        return $message;
    }
}
/*
Ex:
echo vadation('required', 'E-mail'); // O campo E-mail é obrigatório.


*/