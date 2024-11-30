<?php	
$conectar = mysqli_connect ("localhost", "root", "", "motos");

$cod = $_POST["codigo"];
$funcao = $_POST["funcao"];

if ($funcao == "administrador") {
    $senha = $_POST["senha"];
    // Aqui você deve usar password_hash() para criptografar a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); 
    $sql_altera = "UPDATE funcionarios 		
                  SET 		
                            Senha = '$senha_criptografada'
                            
                  WHERE 	Cod_Fun = '$cod'";
    $sql_resultado_alteracao = mysqli_query ($conectar, $sql_altera);

    if ($sql_resultado_alteracao == true)
    {
        echo "<script>
                alert ('Senha do administrador alterada com sucesso') 
              </script>";
        echo "<script> 
                 location.href = ('lista_fun.php') 
              </script>";
        exit();
    }  
    else
    {    
        echo "<script> 
                alert ('Ocorreu um erro no servidor. 
                        A senha do administrador não foi alterada. 
                                                Volte e tente de novo') 
            </script>";
        echo "<script> 
                location.href ('altera_fun.php?codigo=$cod') 
             </script>";
        exit();
    }
}	
else {
    $nome = $_POST["nome"];	
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    // Aqui você deve usar password_hash() para criptografar a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); 
    $status = $_POST["status"];
    $funcao = $_POST["funcao"];
    
    $sql_pesquisa = "SELECT Login FROM funcionarios	
                             WHERE Login = '$login' 							  
                             AND   Cod_Fun <> '$cod'";							  
    $sql_resultado = mysqli_query ($conectar, $sql_pesquisa);
                              
    $linhas = mysqli_num_rows ($sql_resultado);		
    if ($linhas == 1)
    {
        echo "<script> 
                        alert ('Login do funcionário já existente. 
                                                Tente de novo.')  
              </script>";
        echo "<script> 
            location.href = ('altera_fun.php?codigo=$cod')
             </script>";
        exit;	  
    }
    else
    {			
        $sql_altera = "UPDATE funcionarios 		
                      SET 		Nome='$nome', 
                                Funcao = '$funcao',
                                Login ='$login', 
                                Senha = '$senha_criptografada',
                                Status = '$status'
                      WHERE 	Cod_Fun = '$cod'";
        $sql_resultado_alteracao = mysqli_query ($conectar, $sql_altera);		
        if ($sql_resultado_alteracao == true)
        {
            echo "<script>
                    alert ('$nome alterado com sucesso') 
                  </script>";
            echo "<script> 
                     location.href = ('lista_fun.php') 
                  </script>";
            exit();
        }  
        else
        {    
            echo "<script> 
                    alert ('Ocorreu um erro no servidor. 
                                Dados do funcionário não foram alterados.
                                            Tente de novo') 
                </script>";
            echo "<script> 
                    location.href ('altera_fun.php?codigo=
                                                <?php echo $cod; ?>') 
                 </script>";
        }		
    }
}
?>