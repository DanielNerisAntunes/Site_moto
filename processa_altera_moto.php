<?php
$conectar = mysqli_connect("localhost", "root", "", "motos");

$cod = $_POST["codigo"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$ano = $_POST["ano"];
$preco = $_POST["preco"];
$tipo = $_POST["tipo"];
$foto = $_FILES["foto"];

// Verificar se uma nova foto foi enviada
if ($foto["name"] != "") {
    $foto_nome = "img/" . $foto["name"];
    move_uploaded_file($foto["tmp_name"], $foto_nome);
} else {
    // Se não foi enviada uma foto, obter a foto atual do banco de dados
    $pesquisa_caminho_foto = "SELECT foto_moto FROM motos WHERE Cod_moto = '$cod'";
    $resultado_pesquisa = mysqli_query($conectar, $pesquisa_caminho_foto);
    $registro = mysqli_fetch_row($resultado_pesquisa);
    $foto_nome = $registro[0]; // Mantém o caminho da foto anterior
}

// Usar prepared statements para evitar SQL injection
$sql_altera = "UPDATE motos SET Marca = ?, Modelo = ?, Ano_de_fabricacao = ?, Preco_de_venda = ?, foto_moto = ? WHERE Cod_moto = ?";
$stmt = mysqli_prepare($conectar, $sql_altera);
mysqli_stmt_bind_param($stmt, "sssssi", $marca, $modelo, $ano, $preco, $foto_nome, $cod);
$sql_resultado_alteracao = mysqli_stmt_execute($stmt);

if ($sql_resultado_alteracao) {
    echo "<script>
            alert('$modelo alterado com sucesso');
            location.href = 'lista_motos.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('Ocorreu um erro no servidor. Dados da moto não foram alterados. Tente de novo');
            location.href = 'altera_moto.php?codigo=$cod';
          </script>";
}
?>