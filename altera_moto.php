<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alteração de Motos - Multi Motos</title>
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
            <h1> ALTERAÇÃO DE MOTOS </h1>
            
            <?php
                // Conexão com o banco de dados
                $conectar = mysqli_connect("localhost", "root", "", "motos");
                if (!$conectar) {
                    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
                }
                
                // Obtendo o código da moto
                $cod = $_GET["codigo"];
                                
                // Query para buscar os dados da moto
                $sql_pesquisa = "SELECT 
                                    Cod_moto, 
                                    Marca, 
                                    Modelo, 
                                    Ano_de_fabricacao, 
                                    Preco_de_venda, 
                                    Tipo 
                                FROM 
                                    motos
                                WHERE Cod_moto = '$cod'";
                $resultado_pesquisa = mysqli_query($conectar, $sql_pesquisa);

                if ($resultado_pesquisa && mysqli_num_rows($resultado_pesquisa) > 0) {
                    $registro = mysqli_fetch_row($resultado_pesquisa);
                } else {
                    echo "<p>Moto não encontrada.</p>";
                    exit;
                }
            ?>

            <form method="post" action="processa_altera_moto.php" enctype="multipart/form-data">
                <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($cod); ?>">
                <p>
                    Marca: <input type="text" name="marca" required 
                                  value="<?php echo htmlspecialchars($registro[1]); ?>" >
                </p>
                <p>
                    Modelo: <input type="text" name="modelo" required 
                                   value="<?php echo htmlspecialchars($registro[2]); ?>">
                </p>
                <p>
                    Ano: <input type="text" name="ano" required 
                                value="<?php echo htmlspecialchars($registro[3]); ?>">
                </p>
                <p>
                    Preço: <input type="text" name="preco" required 
                                  value="<?php echo htmlspecialchars($registro[4]); ?>">
                </p>
                <p> Foto: <input type="file" name="foto"> </p>
                <p>
                    Tipo: <select name="tipo">
                            <option value="esporte" <?php if ($registro[5] == "esporte") echo "selected"; ?>>Esporte</option>
                            <option value="street" <?php if ($registro[5] == "street") echo "selected"; ?>>Street</option>
                            <option value="scooter" <?php if ($registro[5] == "scooter") echo "selected"; ?>>Scooter</option>
                        </select>
                </p>
                <p> <input type="submit" value="Alterar Moto"> </p>								
            </form>
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