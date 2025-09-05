<?php
require_once __DIR__."/../../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();

// Gerando token contra ataque CSRF_token
$csrfToken = CsrfValidator::generateToken();
?>

<div class="container" >

    <h1> Cadastrar-se </h1>
    <?php    
        if(!empty($_SESSION['msg'])) {
            foreach($_SESSION['msg'] as $m) {
                echo $m;
            }     
            unset($_SESSION['msg']);
        }
    ?>

    <form method="POST" action="actions/auth/signup.php">       
        
        <input type="hidden" name="csrf_token" value="<?=$csrfToken;?>">

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="nome" required>  
            <label for="floatingInput">Nome</label>          
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="email" id="email" required>
            <label for="floatingInput">E-mail</label>           
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" required>
            <label for="floatingInput">Senha</label>      
            <div id="passwordHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="telefone" id="telefone" required>
            <label for="floatingInput">Telefone</label>            
        </div>
        
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>


</div>


<?php
    require 'pages/footer.php';