<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];
    $autor = $_POST['autor'];

    $sqlUpdate = "UPDATE autores SET nome='$autor' WHERE id=$id";

    $result = $conexao->query($sqlUpdate);

    header('Location: ../tela-cadastrada/relatorio_autor.php');
?>