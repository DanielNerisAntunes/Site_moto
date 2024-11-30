<?php	
$conectar = mysqli_connect ("localhost", "root", "", "motos");	
$cod = $_GET["codigo"];	

$sql_altera = "UPDATE motos 		
              SET 		Status_de_disponibilidade = 'DISPONIVEL' 
              WHERE 	Cod_moto = '$cod'";
$sql_resultado_alteracao = mysqli_query ($conectar, $sql_altera);

if ($sql_resultado_alteracao == true)
{
    echo "<script>
            alert ('Moto retirada da fila de compra com sucesso') 
          </script>";
    echo "<script> 
             location.href = ('vendas.php') 
          </script>";
    exit();
}  
else
{    
    echo "<script> 
            alert ('Ocorreu um erro no servidor. 
        A moto não foi retirada da fila de compras. Tente de novo') 
        </script>";
    echo "<script> 
            location.href ('ver_fila_compra.php') 
         </script>";
}
?>