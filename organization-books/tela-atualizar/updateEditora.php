<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];
    $editora = $_POST['editora'];

    $sqlUpdate = "UPDATE editora SET nome='$editora' WHERE id=$id";

    $result = $conexao->query($sqlUpdate);

    header('Location: ../tela-cadastrada/relatorio_editora.php');
?>