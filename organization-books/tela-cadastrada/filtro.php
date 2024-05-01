<?php
    session_start();
    $tema = $_POST['tema'];
    $ordem = $_POST['ordem'];
    $coluna = '';
    $filtroOrdem = '';

    $nome_pesq = $_POST['nome_pesq'];
    $_SESSION['nomePesq'] = $nome_pesq;

    switch ($ordem) {

        case 1:
            $filtroOrdem = "ASC";
            break;

        case 2:
            $filtroOrdem = "DESC";
            break;
        case 3:
            $filtroOrdem = "ASC";
            break;
        case 4:
            $filtroOrdem = "DESC";
            break;
        default:
            # code...
            break;
    }


    if ($tema == 1) {

        if ($ordem == 3 || $ordem == 4) {
            $coluna = "id_liv";
            header("Location: relatorio_livro.php");
        } else {
            $coluna = 'liv_nome';
            header("Location: relatorio_livro.php");
        }


    } else if ($tema == 2) {

        if ($ordem == 3 || $ordem == 4) {
            $coluna = "id";
            header("Location: relatorio_editora.php");
        } else {
            $coluna = 'nome';
            header("Location: relatorio_editora.php");
        }

    } else if ($tema == 3) {

        if ($ordem == 3 || $ordem == 4) {
            $coluna = "id_leitor";
            header("Location: relatorio_leitor.php");
        } else {
            $coluna = 'leitor_nome';
            header("Location: relatorio_leitor.php");
        }

    } else if ($tema == 4) {

        if ($ordem == 3 || $ordem == 4) {
            $coluna = "id";
            header("Location: relatorio_autor.php");
        } else {
            $coluna = 'nome';
            header("Location: relatorio_autor.php");
        }
    } else {
        header("Location: relatorio.html");
    }
    
    session_start();
    $_SESSION['coluna'] = $coluna;
    $_SESSION['filtroOrdem'] = $filtroOrdem;

?>