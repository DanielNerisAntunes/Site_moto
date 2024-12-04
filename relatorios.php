<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cod_fun'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Relatórios</title>
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
            <div id="menu_global" class="menu_global">
                <p align="right"> Olá <?php include "valida_login.php"; ?> </p>
                <?php include "menu_local.php"; ?>               
            </div>
        </div>
        <div id="conteudo_especifico">
            <h1> RELATÓRIOS </h1>
            <ul type="none">
                <li><a href="rel_funcionarios.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'rel_funcionarios.php') ? 'active' : ''; ?>">Relatório de Funcionários</a></li>
                <li><a href="rel_estoque.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'rel_estoque.php') ? 'active' : ''; ?>">Relatório de Motos em Estoque</a></li>
                <li><a href="rel_total_vendas.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'rel_total_vendas.php') ? 'active' : ''; ?>">Faturamento Total do Mês</a></li>				
            </ul>  
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