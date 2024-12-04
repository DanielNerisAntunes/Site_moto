<?php
// Estabelecer conexão com o banco de dados
$conectar = mysqli_connect("localhost", "root", "", "motos");

// Verificar se a conexão foi bem-sucedida
if (!$conectar) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Obter o código da moto a partir da URL
$cod = $_GET["codigo"];

// Preparar a consulta SQL para evitar SQL Injection
$sql_altera = "UPDATE motos 
               SET Status_de_disponibilidade = 'DISPONIVEL' 
               WHERE Cod_moto = ?";

// Preparar a consulta
$stmt = mysqli_prepare($conectar, $sql_altera);

// Verificar se a preparação da consulta foi bem-sucedida
if ($stmt === false) {
    die("Erro na preparação da consulta: " . mysqli_error($conectar));
}

// Vincular o parâmetro (código da moto) à consulta preparada
mysqli_stmt_bind_param($stmt, "i", $cod);  // 'i' para inteiro

// Executar a consulta
$sql_resultado_alteracao = mysqli_stmt_execute($stmt);

if ($sql_resultado_alteracao) {
    echo "<script>
            alert('Moto retirada da fila de compra com sucesso');
          </script>";
    echo "<script>
            location.href = 'vendas.php';
          </script>";
    exit();
} else {
    // Em caso de erro, é bom registrar o erro
    echo "<script>
            alert('Ocorreu um erro no servidor. A moto não foi retirada da fila de compras. Tente de novo');
          </script>";
    echo "<script>
            location.href = 'ver_fila_compra.php';
          </script>";
}

// Fechar a declaração e a conexão com o banco de dados
mysqli_stmt_close($stmt);
mysqli_close($conectar);
?>