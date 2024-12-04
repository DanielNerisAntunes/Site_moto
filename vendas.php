<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vendas</title>
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
            <h1> VENDAS </h1>
            
            <?php
                // Conexão com o banco de dados com verificação de erros
                $conectar = mysqli_connect("localhost", "root", "", "motos");

                if (!$conectar) {
                    die("Falha na conexão: " . mysqli_connect_error());
                }

                // Consulta para buscar motos disponíveis
                $sql_consulta = "SELECT Cod_moto, Marca, Modelo, Ano_de_fabricacao, Preco_de_venda 
                                 FROM motos 
                                 WHERE Cod_Venda IS NULL 
                                 AND Status_de_disponibilidade = 'DISPONIVEL'";

                $resultado_consulta = mysqli_query($conectar, $sql_consulta);

                if (!$resultado_consulta) {
                    echo "Erro na consulta: " . mysqli_error($conectar);
                }
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
                    if (mysqli_num_rows($resultado_consulta) > 0) {
                        while ($registro = mysqli_fetch_assoc($resultado_consulta)) {
                ?>                      
                <tr height="50px">
                    <td class="esquerda"><?php echo htmlspecialchars($registro['Marca']); ?></td>
                    <td>
                        <a href="exibe_moto.php?codigo=<?php echo urlencode($registro['Cod_moto']); ?>"> 
                            <?php echo htmlspecialchars($registro['Modelo']); ?>
                        </a>
                    </td>
                    <td class="esquerda"><?php echo htmlspecialchars($registro['Ano_de_fabricacao']); ?></td>
                    <td class="esquerda"><?php echo htmlspecialchars($registro['Preco_de_venda']); ?></td>                          
                    <td class="direita">
                        <a href="processa_fila_compras.php?codigo=<?php echo urlencode($registro['Cod_moto']); ?>">
                            Colocar na fila de compras  
                        </a>
                    </td>
                </tr>
                <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhuma moto disponível para venda.</td></tr>";
                    }
                ?>
            </table>
            <p> <a href="ver_fila_compras.php"> Ver a fila de compras </a> </p>
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