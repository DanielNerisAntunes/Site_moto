<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro de Funcionários - Multi Motos</title>
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
            <h1> CADASTRO DE FUNCIONÁRIOS </h1>
            
            <form method="post" action="processa_cadastra_fun.php">
                <table class="centralizar">    
                    <tr>
                        <td><p> Nome: </p></td>
                        <td><p> <input type="text" name="nome" required> </p></td>
                    </tr>
                    <tr>
                        <td><p> Função: </p></td>
                        <td>
                            <p> 
                                <input type="radio" name="funcao" value="estoquista" checked> Estoquista
                                <input type="radio" name="funcao" value="vendedor"> Vendedor 
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><p> Login: </p></td>
                        <td><p> <input type="text" name="login" required> </p></td>
                    </tr>
                    <tr>
                        <td><p> Senha: </p></td>
                        <td><p> <input type="password" name="senha" required> </p></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p> <input type="submit" value="Cadastrar Funcionário"> </p>
                        </td>
                    </tr>
                </table>
            </form>
                            
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