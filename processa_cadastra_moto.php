<?php
$conectar = mysqli_connect ("localhost", "root", "", "motos");

$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$ano = $_POST["ano"];
$cor = $_POST["cor"];
$chassi = $_POST["chassi"];
$cilindrada = $_POST["cilindrada"];
$tipo = $_POST["tipo"];
$preco_custo = $_POST ["preco_custo"];
$preco_venda = $_POST["preco_venda"];
$quantidade = $_POST["quantidade"];
$combustivel = $_POST["combustivel"];
$potencia = $_POST["potencia"];
$freios = $_POST["freios"];
$abs = $_POST["abs"];
$peso = $_POST["peso"];
$tanque = $_POST["tanque"];
$partida = $_POST["partida"];
$status = $_POST["status"];
$foto = $_FILES["foto"];

$foto_nome = "img/".$foto["name"];
move_uploaded_file($foto["tmp_name"], $foto_nome);

$sql_cadastrar = "INSERT INTO motos (Marca, 
                                        Modelo, 
                                        Ano_de_fabricacao, 
                                        Cor, 
                                        Numero_do_chassi, 
                                        Cilindrada, 
                                        Tipo, 
                                        Preco_de_custo, 
                                        Preco_de_venda, 
                                        Quantidade_em_estoque, 
                                        Tipo_de_combustivel, 
                                        Potencia, 
                                        Sistema_de_freios, 
                                        Abs, 
                                        Peso, 
                                        Capacidade_do_tanque, 
                                        Tipo_de_partida, 
                                        Status_de_disponibilidade, 
                                        foto_moto) 
                  VALUES 			    ('$marca',
                                        '$modelo', 
                                        '$ano',
                                        '$cor',
                                        '$chassi',
                                        '$cilindrada',
                                        '$tipo',
                                        '$preco_custo',
                                        '$preco_venda',
                                        '$quantidade',
                                        '$combustivel',
                                        '$potencia',
                                        '$freios',
                                        '$abs',
                                        '$peso',
                                        '$tanque',
                                        '$partida',
                                        '$status',
                                        '$foto_nome')";
                                        
$sql_resultado_cadastrar = mysqli_query ($conectar, $sql_cadastrar);

if ($sql_resultado_cadastrar == true) { 	
    echo "<script>
            alert ('$modelo cadastrado com sucesso') 
          </script>";
    echo "<script>
            location.href = ('cadastra_moto.php') 
          </script>";		
}
else { 	
    echo "<script> 
            alert ('ocorreu um erro no servidor ao 
                                        tentar cadastrar') 
          </script>";		
    echo "<script> 
            location.href = ('cadastra_moto.php') 
          </script>";	
}
?>