<?php

include_once("../backend/coneccao.php");

$id_seg = $_GET['id'];
$id = $_POST['identificacao'];
$nome = $_POST['nome'];
$editora = $_POST['editora'];
$autor = $_POST['autor'];
$edicao = $_POST['edicao'];
$isbn = $_POST['isbn'];
$genero = $_POST['genero'];


// Conferir autor
    $conferirAutor = "SELECT * FROM autores WHERE nome = '$autor'";
    $localizarAutor = mysqli_query($conexao, $conferirAutor) or die(mysql_error());
    $registroAutor = mysqli_num_rows($localizarAutor);
    if ($registroAutor == 0) {
        header("Location: ../backend/autor-erro.php");
    }

// Conferir editora
    $conferirEditora = "SELECT * FROM editora WHERE nome = '$editora'";
    $localizarEditora = mysqli_query($conexao, $conferirEditora) or die(mysql_error());
    $registroEditora = mysqli_num_rows($localizarEditora);
    if ($registroEditora == 0) {
        header("Location: ../backend/editora-erro.php");
    }

$sql = "select * from livros where id_liv = '$id'";
$localizarUsuario = mysqli_query($conexao, $sql) or die(mysql_error());
$registro = mysqli_num_rows($localizarUsuario);

if ($registroAutor != 0 && $registroEditora != 0) {

    $sqlUpdate = "  UPDATE livros 
                    SET id_liv='$id', liv_nome='$nome', liv_autor='$autor', liv_editora='$editora', isbn='$isbn', liv_genero='$genero'
                    WHERE id_seg=$id_seg
    ";

    $result = $conexao->query($sqlUpdate);

    header('Location: ../tela-cadastrada/relatorio_livro.php');
} else {
    echo "Erro";
    echo "oiii";
}
?>