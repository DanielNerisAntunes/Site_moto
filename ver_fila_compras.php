<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fila de Compras</title>
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
            <h1> FILA DE COMPRAS </h1>
            
            <?php
                // Conectar com o banco de dados com verificação de erro
                $conectar = mysqli_connect("localhost", "root", "", "motos");

                if (!$conectar) {
                    die("Erro de conexão: " . mysqli_connect_error());
                }

                // Preparar consulta
                $sql_consulta = "SELECT Cod_moto, Marca, Modelo, Ano_de_fabricacao, Preco_de_venda 
                                 FROM motos 
                                 WHERE Cod_Venda IS NULL AND Status_de_disponibilidade = 'RESERVADO'";
                $resultado_consulta = mysqli_query($conectar, $sql_consulta);

                if (!$resultado_consulta) {
                    echo "Erro na consulta: " . mysqli_error($conectar);
                }

                // Inicializar variável para total
                $valor_total = 0;
            ?>
            
            <table width="100%">
                <tr height="50px">
                    <td class="esquerda">Marca</td>
                    <td>Modelo</td>
                    <td>Ano</td>
                    <td>Preço</td>                         
                    <td class="direita">Ação</td>
                </tr>
                <?php	
                    // Exibir resultados da consulta
                    while ($registro = mysqli_fetch_assoc($resultado_consulta)) {
                        $valor_total += $registro['Preco_de_venda']; // Adiciona ao total
                ?>                      
                <tr height="50px">
                    <td><?php echo htmlspecialchars($registro['Marca']); ?></td>
                    <td>
                        <a href="exibe_moto.php?codigo=<?php echo urlencode($registro['Cod_moto']); ?>"> 
                            <?php echo htmlspecialchars($registro['Modelo']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($registro['Ano_de_fabricacao']); ?></td>
                    <td class="esquerda"><?php echo htmlspecialchars($registro['Preco_de_venda']); ?></td>                          
                    <td>
                        <a href="processa_retira_fila_compras.php?codigo=<?php echo urlencode($registro['Cod_moto']); ?>">
                            Retirar da fila de compras	
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <p>Total: <?php echo number_format($valor_total, 2, ',', '.'); ?></p>
            <p><a href="vendas.php">Voltar à seleção de motos</a></p>
            <p><a href="recibo_venda.php">Finalizar venda</a></p>
            
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