<?php
if ($_SESSION["funcao_fun"] == "administrador") {
?>
<ul>
    <li><a href="administracao.php" class="active">Administração</a></li>
    <li><a href="lista_fun.php" class="active">Funcionários</a></li>
    <li><a href="lista_motos.php">Motos</a></li>
    <li><a href="vendas.php">Vendas</a></li>     
    <li><a href="relatorios.php">Relatorios</a></li>
    <li><a href="logout.php" class="active">Sair</a></li>  
</ul> 
<?php
} elseif ($_SESSION["funcao_fun"] == "estoquista") {
?>
<ul>
    <li><a href="administracao.php" class="active">Administração</a></li>
    <li><a href="lista_motos.php">Motos</a></li>  
    <li><a href="logout.php" class="active">Sair</a></li>
</ul> 
<?php		
} else {
?>
<ul>
    <li><a href="administracao.php" class="active">Administração</a></li>
    <li><a href="vendas.php">Vendas</a></li>    
    <li><a href="logout.php" class="active">Sair</a></li>
</ul> 
<?php		
}
?>