<?php
if ( isset($_SESSION["nome_fun"]) ) {
    echo $_SESSION["nome_fun"];
} else {
    // Redirecionamento sem alert
    echo "<script> location.href = ('index.php') </script>"; 
}
?>