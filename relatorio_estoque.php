<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cod_fun'])) {
    header('Location: index.php');
    exit();
}

$conectar = mysqli_connect("localhost", "root", "", "motos");

// Verifica a conexão com o banco de dados
if (!$conectar) {
    die("Erro de conexão: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Relatório de Estoque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
</head>
<body>
    <div id="principal">
        <div id="topo">
            <div id="logo">
                <h1> LOJA DE MOTOS </h1>
                <h1> Nome da Loja </h1>
            </div>
            <div id="menu_global"  class="menu_global">
                <p align="right"> Olá <?php include "valida_login.php"; ?> </p>
                <?php include "menu_local.php"; ?>               
            </div>
        </div>
        <div id="conteudo_especifico">
            <h1> RELATÓRIO DE ESTOQUE </h1>
            <?php
                $sql_pesquisa = "SELECT Marca, Modelo, Preco_de_venda
                                 FROM motos
                                 WHERE Status_de_disponibilidade = 'DISPONIVEL' 
                                    OR Status_de_disponibilidade = 'RESERVADO'";
                $resultado_pesquisa = mysqli_query($conectar, $sql_pesquisa);

                // Verifica se a consulta foi bem-sucedida
                if (!$resultado_pesquisa) {
                    die("Erro ao consultar estoque: " . mysqli_error($conectar));
                }
            ?>
            <table width="100%">
                <tr height="50px">
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Preço</th>
                </tr>
                <?php
                    while ($registro = mysqli_fetch_row($resultado_pesquisa)) {
                ?>
                <tr height="50px">
                    <td><?php echo $registro[0]; ?></td>
                    <td><?php echo $registro[1]; ?></td>
                    <td><?php echo number_format($registro[2], 2, ',', '.'); ?></td>
                </tr>
                <?php
                    }
                ?>
            </table>

            <p> <a href="relatorios.php"> Voltar </a> </p>
                            
        </div>  
        <div id="rodape">
            <div id="texto_institucional">
                <h6> CONTROLE DE MOTOS </h6> 
                <h6> Rua das Motos, 123 -- E-mail: contato@lojademotos.com.br -- Fone: (11) 9999-9999 </h6> 
            </div>  
        </div>
    </div>
</body>
</html>