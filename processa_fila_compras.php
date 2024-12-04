<?php	
// Estabelecendo conexão com o banco de dados
$conectar = mysqli_connect("localhost", "root", "", "motos");

$cod = $_GET["codigo"];

// Verificar se a conexão foi bem-sucedida
if (!$conectar) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Preparar a consulta SQL para atualizar o status da moto
$sql_altera = "UPDATE motos SET Status_de_disponibilidade = ? WHERE Cod_moto = ?";

// Preparar a consulta
$stmt = mysqli_prepare($conectar, $sql_altera);

// Verificar se a preparação foi bem-sucedida
if ($stmt === false) {
    die("Erro na preparação da consulta: " . mysqli_error($conectar));
}

// Vincular os parâmetros à consulta preparada
$status = 'RESERVADO';  // Definindo o status como 'RESERVADO'
mysqli_stmt_bind_param($stmt, "si", $status, $cod);  // 's' para string, 'i' para inteiro

// Executar a consulta
if (mysqli_stmt_execute($stmt)) {
    echo "<script>
            alert('Moto colocada na fila de compra com sucesso');
          </script>";
    echo "<script>
            location.href = 'vendas.php';
          </script>";
} else {
    echo "<script>
            alert('Ocorreu um erro no servidor. A moto não foi colocada na fila de compras. Tente de novo');
          </script>";
    echo "<script>
            location.href = 'vendas.php';
          </script>";
}

// Fechar a declaração e a conexão
mysqli_stmt_close($stmt);
mysqli_close($conectar);
?>