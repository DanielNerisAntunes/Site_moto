<?php  
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Recibo</title>
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
                <h1> RECIBO </h1>
                <?php
                    $conectar = mysqli_connect("localhost", "root", "", "motos");
                    
                    // inserindo um registro novo na tabela venda para iniciar o
                    // processo de registro/cadastro de uma nova venda
                    $data = date('d/m/Y');
                    $hora = date('H:i:s');
                    $cod_fun = $_SESSION['cod_fun'];
                    $sql_registro_venda = "INSERT INTO vendas
                                            (Data, Hora, Responsavel_pela_venda, Cod_Fun)
                                            VALUES ('$data', '$hora', '$nome_funcionario', '$cod_fun')";
                                            
                    $resultado_registro_venda = mysqli_query($conectar, $sql_registro_venda);
                    
                    // pesquisando e extraindo da pesquisa feita o código da última venda para colocá-lo posteriormente na tabela dos MOTOS para identificar em que venda a moto está
                    
                    $sql_consulta_ultima_venda = "SELECT Cod_Venda
                                                    FROM vendas 
                                                    ORDER BY Cod_Venda DESC 
                                                    LIMIT 1";
                    
                    $resultado_consulta = mysqli_query($conectar, $sql_consulta_ultima_venda);		
                                            
                    $registro_cod_ven = mysqli_fetch_row($resultado_consulta);
                    
                    
                    // alteração na do campo chave estrangeira na tabela MOTOS
                    // servirá para saber em que venda está (ou estão) a(s) moto(s)
                    
                    $sql_codigo_venda_em_moto = "UPDATE motos
                                                SET Cod_Venda = '$registro_cod_ven[0]',
                                                                         Status_de_disponibilidade = 'VENDIDA'
                                                                        WHERE Status_de_disponibilidade = 'RESERVADO'";
                                                        
                    $resultado_alteracao_moto = mysqli_query($conectar, $sql_codigo_venda_em_moto);
                    
                    // exibição dos dados do recibo                  
                    
                    $sql_consulta_recibo = "SELECT  
                                                Marca,  
                                                Modelo,  
                                                Preco_de_venda  
                                        FROM motos  
                                        WHERE Cod_Venda = '$registro_cod_ven[0]'";
                    
                    $resultado_consulta = mysqli_query($conectar, $sql_consulta_recibo);                    
                    echo "<p> Venda nº: $registro_cod_ven[0]</p>";
                    echo "<p> Data: $data</p>";
                    echo "<p> Hora: $hora</p>";
                ?>
                
                <table width="100%">
                    <tr>
                        <td>
                            <p> Marca </p>
                        </td>
                        <td>
                            <p> Modelo </p>
                        </td>                         
                        <td>
                            <p> Preço </p>
                        </td>                      
                    </tr>
                    <?php
                        $valor_total = 0;
                        while ($registro = mysqli_fetch_row($resultado_consulta))
                        {
                    ?>                      
                    <tr>
                        <td>
                            <p>
                                <?php echo "$registro[0]"; ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <?php echo "$registro[1]";	?>                                        
                            </p>
                        </td>
                        <td>
                            <p>
                                <?php  
                                    echo "$registro[2]";  
                                    $valor_total = $valor_total + $registro[2];
                                ?>
                            </p>
                        </td>                         
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <p> Total: <?php echo $valor_total; ?> </p>
                <p> <a href="vendas.php"> Fechar recibo </a> </p>
            </div>
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