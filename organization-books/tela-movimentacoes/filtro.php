<?php
    session_start();
    $ordem = $_POST['ordem'];
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
        default:
            # code...
            break;
    }

    // $_SESSION['coluna'] = $coluna;
    if($filtroOrdem == ''){
        $filtroOrdem = 'ASC';
    }else{
        $_SESSION['filtroOrdem'] = $filtroOrdem;
    }

    header('Location: registro_alugueis.php')

?>