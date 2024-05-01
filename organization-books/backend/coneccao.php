<?php
    // Criando conexão com servidor e banco de dados
    $servidorConexao = "localhost";
    $usuarioConexao = "root";
    $senhaconexao = "";
    $BD = "banco-organization";
       
    // Codigo de conexâo ao banco
    $conexao = mysqli_connect($servidorConexao, $usuarioConexao, $senhaconexao, $BD) or die(mysql_error());
?>