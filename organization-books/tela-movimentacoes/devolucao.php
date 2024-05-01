<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];
    $dt_entrega = $_POST['dt_entrega'];

    $sqlUpdate = "UPDATE alugueis SET dt_entrega='$dt_entrega' WHERE id_aluguel=$id";

    $result = $conexao->query($sqlUpdate);

    header('Location: alugueis_pedentes.php');
?>