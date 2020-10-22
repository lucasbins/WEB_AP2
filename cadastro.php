<!DOCTYPE html>
<html lang="Pt-br">
<meta charset="utf-8"/>
    <head>
        <title>AP1_2 - Lucas bins - Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body style="background-color: black">
        <div class="card" style="width: 500px; margin: auto;padding: 25px;margin-top: 100px;">
            <h2>Cadastro de Usuário</h2>
            <form method="POST" action="cadastro.php" >
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome">

                <label for="login">Login</label>
                <input type="text" class="form-control" name="login">

                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha">

                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email">

                <label for=fone>Telefone</label>
                <input type="text" class="form-control phone-ddd-mask" placeholder="Ex.: (00) 0000-0000" name="fone">

                <label for=nasc>Data de Nascimento</label>
                <input type=date class="form-control" name=nascimento>

                <label for=func>Função</label>
                <select name=func class="form-control">
                	<option>Professor</option>
                	<option>Aluno</option>
                </select>
                <br>
                <br>
                <?php if(isset($_GET['error'])){
                    echo '<div class="alert alert-danger" role="alert" style="width: 400px;margin: auto;">
                        Login ou senha nao podem ser deixados em branco.
                        </div><br>';}?>
                <button type="reset" value="entrar" class="btn btn-primary">Limpar</button>
                <button type="submit" value="entrar" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </body>
</html>

<?php

	if(count($_POST)!=0){

		if($_POST['login'] != '' AND $_POST['senha'] != ''){
			$nome = $_POST['nome'];
			$login = $_POST['login'];
			$senha = $_POST['senha'];
			$email = $_POST['email'];
			$fone = $_POST['fone'];
			$nasc = $_POST['nascimento'];
			$funcao = $_POST['func'];

            try{
                $conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root");
                echo "Conectado";
            }catch( PDOexception $e){
                echo 'Erro ao conectar om MySQL: ' . $e->getMessage();
            }

			$query = $conn->prepare("INSERT INTO tb_usuarios (nome,login,senha,email,fone,nasc,funcao) VALUES (:nome,:login,:senha,:email,:fone,:nasc,:func)");
			$query->bindParam(":nome",$nome);
            $query->bindParam(":login",$login);
            $query->bindParam(":senha",$senha);
            $query->bindParam(":email",$email);
            $query->bindParam(":fone",$fone);
            $query->bindParam(":nasc",$nasc);
            $query->bindParam(":func",$funcao);
			$query->execute();

			var_dump($_POST);

			header('location:index.php?sucess=1');
		}else{
			header('location:cadastro.php?error=1');
		}
	}

?>
