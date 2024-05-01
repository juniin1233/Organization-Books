<?php
if (empty($_GET['editora'])) {
    $editora = '';
} else {
    $editora = $_GET['editora'];
}

if (empty($_GET['autor'])) {
    $autor = '';
} else {
    $autor = $_GET['autor'];
}
?>

</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/tela-cadastro.css">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../style/botao.css">
    <style>
        .inputBox select option {
            background-color: #732407;
            font-size: 1.2rem;
            color: white;
        }

        form {
            margin-top: 80px;
        }

       
    </style>
    <title>Organization Books</title>
</head>

<body>
    <main>

        <!-- Fundo Padrão de Todas as Telas -->

        <div id="tela_principal">
            <div id="img"></div>
        </div>

        <!-- Parte do Corpo -->

        <div id="div_main">
            <h1>Organization Books</h1>
            <h2>Cadastro de Livros</h2>
            <form action="../backend/cadastro_livro.php" method="post">
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="identificacao" class="inputUser" required>
                        <label for="nome" class="labelInput">Identificação</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="nome" class="inputUser" required>
                        <label for="nome" class="labelInput">Nome</label>
                    </div>
                </div>
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="editora" class="inputUser" value="<?php echo $editora ?>" required>
                        <label for="nome" class="labelInput">Editora</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="autor" class="inputUser" value="<?php echo $autor ?>" required>
                        <label for="nome" class="labelInput">Autor</label>
                    </div>
                </div>
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="edicao" class="inputUser" required>
                        <label for="edicao" class="labelInput">Edição</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="isbn" class="inputUser" required>
                        <label for="nome" class="labelInput">ISBN</label>
                    </div>
                </div>
                <div class="box" id="box-meio">
                    <div class="inputBox">
                        
                        <select name="genero" class="inputUser">
                            <option disabled selected>Gênero</option>
                            <option value="Romance">Romance</option>
                            <option value="Drama" >Drama</option>
                            <option value="Fantasia" >Fantasia</option>
                            <option value="Comédia" >Comédia</option>
                            <option value="Aventura" >Aventura</option>
                            <option value="Mistério" >Mistério</option>
                            <option value="Ficção Científica">Ficção Científica</option>
                            <option value="Poesia" >Poesia</option>
                            <option value="Terror" >Terror</option>
                            <option value="Fatos Reais">Fatos Reais</option>
                            <option value="Outros" >Outros</option>
                        </select>
                        

                        <!-- <input type="text" name="genero" class="inputUser" required> -->
                        <!-- <label for="nome" class="labelInput">Gênero</label>     -->
                    </div>
                </div>
                <div id="box-button">
                    <input type="submit" value="Cadastrar" id="button">
                </div>
            </form>
        </div>
        <a href="../tela_cadastro.html" id="voltar"><img src="../img/voltar.png" alt="voltar"></a>
        <a href="../tela-cadastrada/relatorio.html" id="relatorio">
            <img src="../img/livros-relatorios.png" alt="feito">
        </a>
    </main>
</body>

</html>