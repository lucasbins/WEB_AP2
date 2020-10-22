<?php
	session_start();
	if(count($_POST)!=0){
		$dados = $_POST;

		$login = $dados['login'];
		$senha = $dados['senha'];

		try{
                $conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root");
            }catch( PDOexception $e){
                echo 'Erro ao conectar om MySQL: ' . $e->getMessage();
        }

		$stmt = $conn->prepare("SELECT * FROM tb_usuarios WHERE login = '$login' AND senha = '$senha';");
		$stmt->execute();

		$result = $stmt->fetch();

		$user = $result["login"];
		$pw = $result["senha"];

		if($user == $login && $pw == $senha){
			$_SESSION['login'] = $login;
			header('location: pagina.php');
		}else{
			session_destroy();
  			header('location: index.php?error=1');
  		}
	}

	if(isset($_GET['logout'])){
		session_unset();
		session_destroy();
		header('location: index.php');
	}

	
?>
