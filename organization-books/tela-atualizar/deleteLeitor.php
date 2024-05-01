<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];

    $sqlDelete = "DELETE FROM leitores WHERE id_seg=$id";

    $result = $conexao->query($sqlDelete);

    header('Location: ../tela-cadastrada/relatorio_leitor.php');
?>