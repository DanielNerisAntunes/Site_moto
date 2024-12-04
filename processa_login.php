<?php
session_start();

// Estabelecer conexão com o banco de dados
$conectar = mysqli_connect("localhost", "root", "", "moto");

// Verificar se a conexão foi bem-sucedida
if (!$conectar) {
    die("Erro de conexão: " . mysqli_connect_error());
}

$login = $_POST["login"];
$senha = $_POST["senha"];

// Preparar a consulta SQL usando prepared statements para evitar SQL Injection
$sql_consulta = "SELECT Cod_Fun, Nome, Funcao, Senha 
                 FROM funcionarios 
                 WHERE Login = ?";

// Preparar a consulta
$stmt = mysqli_prepare($conectar, $sql_consulta);

// Verificar se a preparação da consulta foi bem-sucedida
if ($stmt === false) {
    die("Erro na preparação da consulta: " . mysqli_error($conectar));
}

// Vincular o parâmetro (login) à consulta preparada
mysqli_stmt_bind_param($stmt, "s", $login);  // 's' para string

// Executar a consulta
mysqli_stmt_execute($stmt);

// Obter o resultado
$resultado_consulta = mysqli_stmt_get_result($stmt);
$linhas = mysqli_num_rows($resultado_consulta);

if ($linhas == 1) {
    // Buscar os dados do funcionário
    $registro = mysqli_fetch_assoc($resultado_consulta);
    
    // Verificar se a senha está correta usando password_verify()
    if (password_verify($senha, $registro["Senha"])) {  // Usando o nome da coluna 'Senha'
        $_SESSION["cod_fun"] = $registro["Cod_Fun"];
        $_SESSION["nome_fun"] = $registro["Nome"];
        $_SESSION["funcao_fun"] = $registro["Funcao"];

        echo "<script> 
                location.href = 'administracao.php'; 
              </script>";
    } else {
        echo "<script> 
                alert('Login ou Senha Incorretos! Digite Novamente!!');
              </script>";
        echo "<script> location.href = 'index.php'; </script>";
    }
} else {
    echo "<script> 
            alert('Login ou Senha Incorretos! Digite Novamente!!');
          </script>";
    echo "<script> location.href = 'index.php'; </script>";
}

// Fechar a declaração e a conexão com o banco de dados
mysqli_stmt_close($stmt);
mysqli_close($conectar);
?>