<?php
// 1. Estabelecer uma conexão com o BD
$conectar = mysqli_connect("localhost", "root", "", "motos");

// 2. Receber os dados do formulário
$nome = $_POST["nome"];
$login = $_POST["login"];
$senha = $_POST["senha"]; 
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); // Criptografar a senha
$funcao = $_POST["funcao"];

// 3. Verificar se o login já existe no banco de dados
$sql_consulta = "SELECT Login FROM funcionarios WHERE Login = ?";
$stmt = mysqli_prepare($conectar, $sql_consulta);
mysqli_stmt_bind_param($stmt, "s", $login); // Bind do parâmetro para o login
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$linhas = mysqli_stmt_num_rows($stmt);

if ($linhas == 1) {
    echo "<script> 
            alert('Login já cadastrado. Tente outro!'); 
          </script>";
    echo "<script> 
            location.href = 'cadastra_fun.php'; 
          </script>";	
} else {
    // 4. Inserir o novo funcionário
    $sql_cadastrar = "INSERT INTO funcionarios (Nome, Funcao, Login, Senha) VALUES (?, ?, ?, ?)";
    $stmt_cadastrar = mysqli_prepare($conectar, $sql_cadastrar);
    mysqli_stmt_bind_param($stmt_cadastrar, "ssss", $nome, $funcao, $login, $senha_criptografada);
    
    if (mysqli_stmt_execute($stmt_cadastrar)) {
        echo "<script> 
                alert('$nome cadastrado com sucesso'); 
              </script>";
        echo "<script> 
                location.href = 'cadastra_fun.php'; 
              </script>";	
    } else {
        echo "<script> 
                alert('Ocorreu um erro no servidor. Tente de novo.'); 
              </script>";
        echo "<script> 
                location.href = 'cadastra_fun.php'; 
              </script>";	
    }
}
?>