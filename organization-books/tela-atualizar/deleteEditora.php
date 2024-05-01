<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];

    $sqlDelete = "DELETE FROM editora WHERE id=$id";

    $result = $conexao->query($sqlDelete);

    header('Location: ../tela-cadastrada/relatorio_editora.php');
?>