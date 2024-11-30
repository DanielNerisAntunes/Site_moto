<?php	
$conectar = mysqli_connect ("localhost", "root", "", "motos");				

$cod = $_POST["codigo"];
$marca = $_POST["marca"];	
$modelo = $_POST["modelo"];
$ano = $_POST["ano"];
$preco = $_POST["preco"];
$tipo = $_POST["tipo"];
$foto = $_FILES["foto"];


if ($foto["name"] <> "") {
    $foto_nome = "img/".$foto["name"];		
    move_uploaded_file($foto["tmp_name"], $foto_nome);
}
else {
    $pesquisa_caminho_foto = "SELECT foto_moto
                             FROM motos
                             WHERE Cod_moto = '$cod'";
    $resultado_pesquisa = mysqli_query ($conectar, $pesquisa_caminho_foto);
    $registro = mysqli_fetch_row ($resultado_pesquisa);
    $foto_nome = $registro[0];
}

$sql_altera = "UPDATE motos 		
              SET 		Marca='$marca', 
                        Modelo = '$modelo',
                        Ano_de_fabricacao ='$ano', 
                        Preco_de_venda ='$preco', 
                        foto_moto = '$foto_nome'
              WHERE 	Cod_moto = '$cod'";
$sql_resultado_alteracao = mysqli_query ($conectar, $sql_altera);

if ($sql_resultado_alteracao == true)
{
    echo "<script>
            alert ('$modelo alterado com sucesso') 
          </script>";
    echo "<script> 
             location.href = ('lista_motos.php') 
          </script>";
    exit();
}  
else
{    
    echo "<script> 
            alert ('Ocorreu um erro no servidor. 
                    Dados da moto não foram alterados. Tente de novo') 
        </script>";
    echo "<script> 
            location.href ('altera_moto.php?codig=$cod') 
         </script>";
}
?>