<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Motos - Multi Motos</title>
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
                <h1> Nome da Loja </h1>
            </div>
            <div id="menu_global"  class="menu_global">
                <p align="right"> Olá <?php include "valida_login.php"; ?> </p>
                <?php include "menu_local.php"; ?>               
            </div>
        </div>
        <div id="conteudo_especifico">				
            <h1> MOTOS </h1>
            
            <?php
                $conectar = mysqli_connect("localhost", "root", "", "motos");			
            
                $sql_consulta = "SELECT 
                                        Cod_moto, 
                                        Marca, 
                                        Modelo, 
                                        Ano_de_fabricacao, 
                                        Preco_de_venda 
                                 FROM motos";
                                 
                $resultado_consulta = mysqli_query($conectar, $sql_consulta);		
            ?>
            <p align="right"> 
                <a href="cadastra_moto.php"> 
                    Cadastrar moto
                </a> 
            </p>
            <table width="100%">
                <tr height="50px">
                    <td>
                        Marca
                    </td>
                    <td>
                        Modelo
                    </td>
                    <td>
                        Ano
                    </td>
                    <td>
                        Preço
                    </td>							
                    <td>
                        Ação
                    </td>
                </tr>
                <?php		
                    while ($registro = mysqli_fetch_row($resultado_consulta)) {
                ?>						
                <tr height="50px">
                    <td>
                        <?php echo $registro[1]; ?>
                    </td>
                    <td>
                        <a href="exibe_moto.php?codigo=<?php echo $registro[0]?>">
                            <?php 
                                echo $registro[2];
                            ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $registro[3]; ?>							
                    </td>
                    <td>
                        <?php echo $registro[4]; ?>							
                    </td>							
                    <td>
                        <a href="altera_moto.php?codigo=<?php echo $registro[0]?>">
                            Alterar	
                        </a>							
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>            
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