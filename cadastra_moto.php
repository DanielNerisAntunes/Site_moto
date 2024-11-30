<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro de Motos</title>
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
                <p align="right"> Olá <?php include "valida_login.php";?> </p>
                <?php include "menu_local.php"; ?>               
            </div>
        </div>
        <div id="conteudo_especifico">
            <h1> CADASTRO DE MOTOS </h1>
            
            <form method="post" action="processa_cadastra_moto.php" enctype="multipart/form-data">
                <p> Marca: <input type="text" name="marca" required> </p>
                <p> Modelo: <input type="text" name="modelo" required> </p>
                <p> Ano: <input type="number" name="ano" required> </p>
                <p> Cor: <input type="text" name="cor" required> </p>
                <p> Chassi: <input type="text" name="chassi" required> </p>
                <p> Cilindrada: <input type="text" name="cilindrada" required> </p>
                <p> Tipo: <input type="text" name="tipo" required> </p>
                <p> Preço de custo: <input type="number" name="preco_custo" required> </p>
                <p> Preço de venda: <input type="number" name="preco_venda" required> </p>
                <p> Quantidade em estoque: <input type="number" name="quantidade" required> </p>
                <p> Tipo de combustível: <input type="text" name="combustivel" required> </p>
                <p> Potência: <input type="text" name="potencia" required> </p>
                <p> Sistema de freios: <input type="text" name="freios" required> </p>
                <p> ABS: <input type="text" name="abs" required> </p>
                <p> Peso: <input type="text" name="peso" required> </p>
                <p> Capacidade do tanque: <input type="text" name="tanque" required> </p>
                <p> Tipo de partida: <input type="text" name="partida" required> </p>
                <p> Status de disponibilidade: <input type="text" name="status" required> </p>
                <p> Foto: <input type="file" name = "foto"> </p>
                <p> <input type="submit" value="Cadastrar Moto"> </p>								
            </form>
        </div>	
        <div id="rodape">
            <div id="texto_institucional">
                <div id="texto_institucional">
                    <h6> CONTROLE DE MOTOS </h6> 
                    <h6> Rua das Motos, 123 -- E-mail: contato@lojademotos.com.br -- Fone: (11) 9999-9999 </h6> 
                </div> 
            </div>
        </div>
    </div>
</body>
</html>