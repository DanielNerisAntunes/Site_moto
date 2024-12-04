<?php
$conectar = mysqli_connect("localhost", "root", "", "motos");

$sql_estoque = "SELECT Cod_moto, Marca, Modelo, Preco_de_venda, Saldo 
                FROM motos 
                WHERE Saldo > 0";  // Filtrando produtos com saldo maior que 0

$resultado_estoque = mysqli_query($conectar, $sql_estoque);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Relatório de Estoque</title>
</head>
<body>
    <h1>Relatório de Estoque (Somente Produtos com Saldo)</h1>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Preço</th>
            <th>Saldo</th>
        </tr>
        <?php while ($registro = mysqli_fetch_row($resultado_estoque)) { ?>
        <tr>
            <td><?php echo $registro[0]; ?></td>
            <td><?php echo $registro[1]; ?></td>
            <td><?php echo $registro[2]; ?></td>
            <td><?php echo $registro[3]; ?></td>
            <td><?php echo $registro[4]; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>