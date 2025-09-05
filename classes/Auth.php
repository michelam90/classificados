<?php 
require_once 'User.php';
class Auth {
    private PDO $pdo;
    private $dir;
    private $user;

    public function __construct(PDO $pdo, string $dir) {
        $this->pdo = $pdo;
        $this->user = new User($this->pdo);
        $this->dir = $dir;
    }

    public function checkToken() {

        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
                   
            $user = $this->user->findByToken($token);

            if($user) { // Verificar se o o token do usuário foi encontrado                
                return $user;
            } else {
                unset($_SESSION['token']);
                header("Location: index.php?page=home");
                exit;
            }
        }                
    }

    public function validateLogin($email, $password): bool {

        $user = $this->user->findbyEmail($email);
        if( !empty($user) ) {
               
            if( password_verify($password, $user['senha']) ) {
               
                // Gerando novo token
                $token = md5(time().rand(0,9999));
                // Passa o token para sessão
                $_SESSION['token'] = $token;
                // Amazena o token novo no usuário no bd
                if( $this->user->updateToken($email, $token) ) {
                    return true;
                }
            }
        }
        return false;
    }



}