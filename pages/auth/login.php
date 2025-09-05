<?php
if (!defined('ACESSO_VALIDO')) {
    // Bloqueia acesso direto ao arquivo
    header("Location: ../../index.php?page=home");
    exit;
}
?>
<div class="container" >

    <h1> Login </h1>

    <?php
    
        if(!empty($_SESSION['msg'])) {

            foreach($_SESSION['msg'] as $m) {
                echo $m;
            }     
            unset($_SESSION['msg']);
        }
    ?>
   
    <form method="POST" action="actions/auth/login.php">
       
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" id="email">            
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp">
            <div id="passwordHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
      
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" style="width: 35%;">Entrar</button>
        </div>
        <a href="index.php?page=auth-signup" class="btn btn-secondary"> Cadastrar-se </a>
    </form>


</div>
