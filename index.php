<!DOCTYPE html>
<html lang="Pt-br">
<meta charset="utf-8"/>
    <head>
        <title>AP1_2 - Lucas bins - Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body style="background-color: black"><?php if(isset($_GET['sucess'])){
                    echo '<div class="alert alert-primary" role="alert" style="width: 400px;margin: auto;">
                        Usuário cadastrado com sucesso
                        </div>';}?>
        <div class="card" style="width: 500px; margin: auto;padding: 25px;margin-top: 100px;">
            <form method="POST" action="func.php" >
                <label for="login">Usuário</label>
                <input type="text" class="form-control" name="login">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha">
                <a href="index.php" class="text-decoration-none" style="float:right;">Limpar</a>
                <br>
                <?php if(isset($_GET['error'])){
                    echo '<div class="alert alert-danger" role="alert" style="width: 400px;margin: auto;">
                        Usuário ou Senha inválidos <a href="#" class="alert-link">clique aqui</a> para realizar o cadastro.
                        </div>';}?>
                    
                <br>
                <a class="btn btn-primary" href="cadastro.php" role="button">Cadastre-se</a>
                <button type="submit" value="entrar" class="btn btn-primary" style="float:right;">Login</button>
            </form>
        </div>
    </body>
</html>