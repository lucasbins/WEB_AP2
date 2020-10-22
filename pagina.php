<?php
	require_once("func.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head charset="utf-8">
        <title>AP1_2 - Lucas bins - Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body style="background-color: black">
        <div class="card" style="width: 500px; margin: auto;padding: 25px;margin-top: 100px;">
            <p class="h1" style="text-align: center;"><?php verifisession();?></p>
            <h3>Informações do usuário:</h3>
            <b><?php dados_user();?></b>
        </div>
    </body>
</html>

<?php

function verifisession(){
	if(session_status() == 2){
		echo 'Bem-vindo<br>'.$_SESSION['login'].'<br>';
		echo '<br><p>Para fazer o logout clique botão.</p>';
		echo '<a class="btn btn-primary" href="func.php?logout=1" role="button">Logout</a>';
	}else{
		echo 'Você não está logado!';
	}
}

function dados_user(){
	$login = $_SESSION['login'];

	try{
                $conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root");
            }catch( PDOexception $e){
                echo 'Erro ao conectar om MySQL: ' . $e->getMessage();
        }

    $stmt = $conn->prepare("SELECT * FROM tb_usuarios WHERE login = '$login'");
    $stmt->execute();
    
	while($row = $result = $stmt->fetch()){
		echo 'Nome: '.$row['nome']. '<br>';
		echo 'E-mail: '.$row['email']. '<br>';
		echo 'Telefone: '.$row['fone']. '<br>';
		echo 'Login: ' .$row['login']. '<br>';
		echo 'Função: '.$row['funcao']. '<br>';
		echo 'Nascimento: '.inverteData($row['nasc']). '<br>';
		echo 'Idade: ' .descobrirIdade($row['nasc']). '<br>';
	}
}

function descobrirIdade($dataNascimento){
    $data       = explode("-",$dataNascimento);
    
    $anoNasc    = $data[0];
    $mesNasc    = $data[1];
    $diaNasc    = $data[2];
 
    $anoAtual   = date("Y");
    $mesAtual   = date("m");
    $diaAtual   = date("d");
 
    $idade      = $anoAtual - $anoNasc;
 
    if ($mesAtual < $mesNasc){
        $idade -= 1;
        return $idade;
    } elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
        $idade -= 1;
        return $idade;
    }else
        return $idade;
}

function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
}

?>	