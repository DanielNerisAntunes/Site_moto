<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Exibição de Motos - Multi Motos</title>
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
            <h1> EXIBIÇÃO DE MOTOS </h1>							
            <?php		
                $conectar = mysqli_connect("localhost", "root", "", "motos");
                $codigo_moto = $_GET["codigo"];
                $sql_pesquisa_moto = "SELECT  
                                            Marca,  
                                            Modelo,  
                                            Ano_de_fabricacao,  
                                            Preco_de_venda,  
                                            foto_moto
                                        FROM  
                                            motos
                                        WHERE  
                                            Cod_moto = '$codigo_moto'";
                $resultado_pesquisa_moto = mysqli_query($conectar, $sql_pesquisa_moto);

                $registro_moto = mysqli_fetch_row($resultado_pesquisa_moto);
            ?>
            <div>
                <img src="<?php echo $registro_moto[4]; ?>" alt="Foto da Moto" width="300px">
            </div>
            <?php
                echo "<p><strong>Marca:</strong> $registro_moto[0]</p>";
                echo "<p><strong>Modelo:</strong> $registro_moto[1]</p>";						
                echo "<p><strong>Ano:</strong> $registro_moto[2]</p>";
                echo "<p><strong>Preço:</strong> R$ $registro_moto[3]</p>";
            ?>													
        </div>	
    </div>	
    <div id="rodape">
        <div id="texto_institucional">
            <h6> CONTROLE DE MOTOS </h6> 
            <h6> Rua das Motos, 123 -- E-mail: contato@multimotos.com.br -- Fone: (11) 9999-9999 </h6> 
        </div>
    </div>
</body>
</html>