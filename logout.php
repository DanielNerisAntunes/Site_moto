<?php
session_start(); // Inicia a sessão
$_SESSION = array(); // Limpa todas as variáveis de sessão
session_unset(); // Libera todas as variáveis de sessão
session_destroy(); // Destrói a sessão
echo "<script> 
        alert('Sessão encerrada com sucesso!'); // Exibe uma mensagem de sucesso
        location.href = ('index.php'); // Redireciona para a página inicial
      </script> ";
?>