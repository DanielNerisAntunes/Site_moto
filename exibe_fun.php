<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Exibição de Dados de Funcionários - Multi Motos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
</head>
<body>
    <div id="principal">
        <div id="topo">
            <div id="logo">
                <h1> MULTI MOTOS </h1>
                <h1> Multi Motos </h1>
            </div>
            <div id="menu_global" class="menu_global">
                <p align="right"> Olá <?php include "valida_login.php"; ?> </p>
                <?php include "menu_local.php"; ?>               
            </div>
        </div>
        <div id="conteudo_especifico">
            <h1> EXIBIÇÃO DE DADOS DE FUNCIONÁRIOS </h1>
            <?php
                // Conexão com o banco de dados
                $conectar = mysqli_connect("localhost", "root", "", "motos");
                
                $cod = $_GET["codigo"];
                
                // Consulta para pegar os dados do funcionário
                $sql_consulta = "SELECT Nome, Login, Funcao, Status 
                                 FROM funcionarios 
                                 WHERE Cod_Fun = '$cod'";
                $sql_resultado = mysqli_query($conectar , $sql_consulta);
                
                $registro = mysqli_fetch_row($sql_resultado);
                
                // Exibição dos dados
                echo "<p><strong>Nome:</strong> $registro[0]</p>";
                echo "<p><strong>Login:</strong> $registro[1]</p>";
                echo "<p><strong>Função:</strong> $registro[2]</p>";
                echo "<p><strong>Status:</strong> $registro[3]</p>";
            ?>
        </div>    
        <div id="rodape">
            <div id="texto_institucional">
                <h6> CONTROLE DE MOTOS </h6> 
                <h6> Rua das Motos, 123 -- E-mail: contato@multimotos.com.br -- Fone: (11) 9999-9999 </h6> 
            </div> 
        </div>
    </div>
</body>
</html>