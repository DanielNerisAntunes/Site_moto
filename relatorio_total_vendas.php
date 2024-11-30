<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Relatório de Total de Vendas</title>
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
            <h1> RELATÓRIO DE TOTAL DE VENDAS </h1>
            <?php
                $conectar = mysqli_connect ("localhost", "root", "", "motos");			
                
                $data = date ('d/m/Y');
                
                $sql_consulta_total_vendas = "SELECT Preco_de_venda
                                                 FROM motos
                                                 WHERE Status_de_disponibilidade = 'VENDIDA'";
                
                $resultado_consulta = mysqli_query ($conectar, $sql_consulta_total_vendas);		
                    
        
                $valor_total = 0;
                while ($registro_total_vendas = mysqli_fetch_row ($resultado_consulta))
                {
                    $valor_total = $valor_total + $registro_total_vendas[0];
            
                }
            ?>
            <p> Total de vendas até a presente data: <?php echo $valor_total; ?>
            
            
            <p> <a href="relatorios.php"> Voltar </a> </p>
        
        </div>	
        <div id="rodape">
            <div id="texto_institucional">
                <div id="texto_institucional">
                    <h6> CONTROLE DE MOTOS </h6> 
                    <h6> Rua das Motos, 123 -- E-mail: contato@lojademotos.com.br -- Fone: (11) 9999-9999 </h6> 
                </div> 
            </div>
    </div>
</body>
</html>