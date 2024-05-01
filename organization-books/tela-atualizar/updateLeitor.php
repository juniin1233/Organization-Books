<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];
    $ra_rg = $_POST['identificacao'];
    $nome = $_POST['nome'];
    $tel = $_POST['celular'];
    $email = $_POST['email'];
    $al_pro = $_POST['al_pro'];


    $sqlUpdate = "  UPDATE leitores 
                    SET id_leitor='$ra_rg', leitor_nome='$nome', leitor_aluno_prof='$al_pro', leitor_tel='$tel', leitor_email='$email'
                    WHERE id_seg=$id
    ";

    $result = $conexao->query($sqlUpdate);

    header('Location: ../tela-cadastrada/relatorio_leitor.php');
?>