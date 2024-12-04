<?php
session_start(); // Assegura que a sessão está ativa

if (isset($_SESSION["nome_fun"])) {
    echo $_SESSION["nome_fun"];
} else {
    // Redirecionamento sem usar JavaScript
    header("Location: index.php");
    exit(); // Garante que o código abaixo não será executado
}
?>