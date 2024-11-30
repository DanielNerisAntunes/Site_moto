<?php
session_start();

$conectar = mysqli_connect("localhost", "root", "", "moto");

$login = $_POST["login"];
$senha = $_POST["senha"];

// Inclua o campo 'Senha' na consulta SQL
$sql_consulta = "SELECT Cod_Fun, Nome, Funcao, Senha 
                     FROM funcionarios
                     WHERE Login = '$login'"; 

$resultado_consulta = mysqli_query($conectar, $sql_consulta);

$linhas = mysqli_num_rows($resultado_consulta);

if ($linhas == 1) {
    $registro = mysqli_fetch_row($resultado_consulta);
    // Verificar se a senha está correta usando password_verify()
    if (password_verify($senha, $registro[3])) {  // Corrigido o índice para 3
        $_SESSION["cod_fun"] = $registro[0];
        $_SESSION["nome_fun"] = $registro[1];
        $_SESSION["funcao_fun"] = $registro[2];

        echo "<script> 
                location.href = ('administracao.php') 
              </script>";
    } else {
        echo "<script> 
                alert ('Login ou Senha Incorretos! Digite Novamente!!') 
              </script>";
        echo "<script> location.href = ('index.php') </script>";
    }
} else {
    echo "<script> 
            alert ('Login ou Senha Incorretos! Digite Novamente!!') 
          </script>";
    echo "<script> location.href = ('index.php') </script>";
}
?>