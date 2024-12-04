<?php
// Estabelecer uma conexão com o banco de dados
$conectar = mysqli_connect("localhost", "root", "", "motos");

// Receber os dados do formulário
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$ano = $_POST["ano"];
$cor = $_POST["cor"];
$chassi = $_POST["chassi"];
$cilindrada = $_POST["cilindrada"];
$tipo = $_POST["tipo"];
$preco_custo = $_POST["preco_custo"];
$preco_venda = $_POST["preco_venda"];
$quantidade = $_POST["quantidade"];
$combustivel = $_POST["combustivel"];
$potencia = $_POST["potencia"];
$freios = $_POST["freios"];
$abs = $_POST["abs"];
$peso = $_POST["peso"];
$tanque = $_POST["tanque"];
$partida = $_POST["partida"];
$status = $_POST["status"];
$foto = $_FILES["foto"];

// Verificar se o arquivo foi enviado e se é uma imagem válida
$foto_nome = "img/" . basename($foto["name"]);
$foto_tipo = strtolower(pathinfo($foto_nome, PATHINFO_EXTENSION));
$foto_tmp = $foto["tmp_name"];
$foto_error = $foto["error"];

// Validar o tipo de arquivo (permitir apenas imagens)
$tipos_permitidos = array("jpg", "jpeg", "png", "gif");
if (!in_array($foto_tipo, $tipos_permitidos)) {
    echo "<script> alert('Somente arquivos de imagem (jpg, jpeg, png, gif) são permitidos.'); </script>";
    echo "<script> location.href = 'cadastra_moto.php'; </script>";
    exit();
}

// Validar se o arquivo foi carregado sem erro
if ($foto_error != UPLOAD_ERR_OK) {
    echo "<script> alert('Erro no upload da imagem. Tente novamente.'); </script>";
    echo "<script> location.href = 'cadastra_moto.php'; </script>";
    exit();
}

// Mover o arquivo para o diretório de destino
if (!move_uploaded_file($foto_tmp, $foto_nome)) {
    echo "<script> alert('Erro ao salvar o arquivo da imagem. Tente novamente.'); </script>";
    echo "<script> location.href = 'cadastra_moto.php'; </script>";
    exit();
}

// Preparar a consulta SQL para inserir os dados no banco de dados
$sql_cadastrar = "INSERT INTO motos 
                  (Marca, Modelo, Ano_de_fabricacao, Cor, Numero_do_chassi, Cilindrada, Tipo, Preco_de_custo, Preco_de_venda, Quantidade_em_estoque, Tipo_de_combustivel, Potencia, Sistema_de_freios, Abs, Peso, Capacidade_do_tanque, Tipo_de_partida, Status_de_disponibilidade, foto_moto) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar a consulta
$stmt = mysqli_prepare($conectar, $sql_cadastrar);

// Vincular os parâmetros
mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $marca, $modelo, $ano, $cor, $chassi, $cilindrada, $tipo, $preco_custo, $preco_venda, $quantidade, $combustivel, $potencia, $freios, $abs, $peso, $tanque, $partida, $status, $foto_nome);

// Executar a consulta
if (mysqli_stmt_execute($stmt)) {
    echo "<script> alert('$modelo cadastrado com sucesso'); </script>";
    echo "<script> location.href = 'cadastra_moto.php'; </script>";
} else {
    echo "<script> alert('Ocorreu um erro no servidor ao tentar cadastrar.'); </script>";
    echo "<script> location.href = 'cadastra_moto.php'; </script>";
}

// Fechar a declaração
mysqli_stmt_close($stmt);
?>