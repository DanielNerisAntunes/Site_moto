<?php
session_start();
$_SESSION = array();
session_unset();
session_destroy();
echo "<script> 
        alert('Sessão encerrada com sucesso!'); 
        location.href = ('index.php') 
      </script> ";
?>