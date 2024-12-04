<?php
$conectar = mysqli_connect("localhost", "root", "", "motos");

$cod = $_POST["codigo"];
$funcao = $_POST["funcao"];

if ($funcao == "administrador") {
    // Alteração de senha para administrador
    $senha = $_POST["senha"];
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    $sql_altera = "UPDATE funcionarios SET Senha = ? WHERE Cod_Fun = ?";
    $stmt = mysqli_prepare($conectar, $sql_altera);
    mysqli_stmt_bind_param($stmt, "si", $senha_criptografada, $cod);
    $sql_resultado_alteracao = mysqli_stmt_execute($stmt);

    if ($sql_resultado_alteracao) {
        echo "<script>
                alert('Senha do administrador alterada com sucesso');
                location.href = 'lista_fun.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Ocorreu um erro no servidor. A senha do administrador não foi alterada. Tente de novo');
                location.href = 'altera_fun.php?codigo=$cod';
              </script>";
        exit();
    }
} else {
    // Alteração de dados de funcionários
    $nome = $_POST["nome"];    
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); 
    $status = $_POST["status"];
    $funcao = $_POST["funcao"];
    
    // Verificar se o login já existe para outro funcionário
    $sql_pesquisa = "SELECT Login FROM funcionarios WHERE Login = ? AND Cod_Fun <> ?";
    $stmt = mysqli_prepare($conectar, $sql_pesquisa);
    mysqli_stmt_bind_param($stmt, "si", $login, $cod);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $linhas = mysqli_num_rows($resultado);
    
    if ($linhas == 1) {
        echo "<script>
                alert('Login do funcionário já existente. Tente de novo.');
                location.href = 'altera_fun.php?codigo=$cod';
              </script>";
        exit();
    } else {        
        // Atualizar os dados do funcionário
        $sql_altera = "UPDATE funcionarios SET Nome = ?, Funcao = ?, Login = ?, Senha = ?, Status = ? WHERE Cod_Fun = ?";
        $stmt = mysqli_prepare($conectar, $sql_altera);
        mysqli_stmt_bind_param($stmt, "sssssi", $nome, $funcao, $login, $senha_criptografada, $status, $cod);
        $sql_resultado_alteracao = mysqli_stmt_execute($stmt);

        if ($sql_resultado_alteracao) {
            echo "<script>
                    alert('$nome alterado com sucesso');
                    location.href = 'lista_fun.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Ocorreu um erro no servidor. Dados do funcionário não foram alterados. Tente de novo');
                    location.href = 'altera_fun.php?codigo=$cod';
                  </script>";
            exit();
        }
    }
}
?>