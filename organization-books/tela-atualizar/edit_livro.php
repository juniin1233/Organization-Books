<?php

    include_once("../backend/coneccao.php");

    $id_seg = $_GET['id'];

    $sql = "SELECT * FROM livros WHERE id_seg=$id_seg";
    $localizar = mysqli_query($conexao, $sql) or die(mysql_error());
    $registro = mysqli_num_rows($localizar);    

    if($registro == 1){
        while($row = mysqli_fetch_assoc($localizar)){
            $id = $row['id_liv'];
            $nome = $row['liv_nome'];
            $autor = $row['liv_autor'];
            $editora = $row['liv_editora'];
            $edicao = $row['liv_edicao'];
            $isbn = $row['isbn'];
            $genero = $row['liv_genero'];
        }
    }
?>
</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        form{
            margin-top: 80px;
        }

        #button{
            margin-left: 10px;
        }

        a#excluir{
            text-decoration: none;
        }
    </style>
    <title>Organization Books</title>

    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
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
            <h2>Atualização de Livros</h2>
            <form action="updateLivro.php?id=<?php echo $id_seg?>" method="post">
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="identificacao" class="inputUser" value="<?php echo $id?>" required>
                        <label for="nome" class="labelInput">Identificação</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="nome" class="inputUser" value="<?php echo $nome?>" required>
                        <label for="nome" class="labelInput">Nome</label>
                    </div>
                </div>
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="editora" class="inputUser" value="<?php echo $editora?>" required>
                        <label for="nome" class="labelInput">Editora</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="autor" class="inputUser" value="<?php echo $autor?>" required>
                        <label for="nome" class="labelInput">Autor</label>
                    </div>
                </div>
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="edicao" class="inputUser" value="<?php echo $edicao?>" required>
                        <label for="edicao" class="labelInput">Edição</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="isbn" class="inputUser" value="<?php echo $isbn?>" required>
                        <label for="nome" class="labelInput">ISBN</label>
                    </div>
                </div>
                <div class="box" id="box-meio">
                    <div class="inputBox">
                        <select name="genero" class="inputUser">
                            <option disabled  <?php echo ($genero == '')?'selected':''?>>Gênero</option>
                            <option value="Romance" <?php echo ($genero == 'Romance')?'selected':''?>>Romance</option>
                            <option value="Drama" <?php echo ($genero == 'Drama')?'selected':''?>>Drama</option>
                            <option value="Fantasia" <?php echo ($genero == 'Fantasia')?'selected':''?>>Fantasia</option>
                            <option value="Comédia" <?php echo ($genero == 'Comédia')?'selected':''?>>Comédia</option>
                            <option value="Aventura" <?php echo ($genero == 'Aventura')?'selected':''?>>Aventura</option>
                            <option value="Mistério" <?php echo ($genero == 'Mistério')?'selected':''?>>Mistério</option>
                            <option value="Ficção Científica" <?php echo ($genero == 'Ficção Científica')?'selected':''?>>Ficção Científica</option>
                            <option value="Poesia" <?php echo ($genero == 'Poesia')?'selected':''?>>Poesia</option>
                            <option value="Terror" <?php echo ($genero == 'Terror')?'selected':''?>>Terror</option>
                            <option value="Fatos Reais" <?php echo ($genero == 'Fatos Reais')?'selected':''?>>Fatos Reais</option>
                            <option value="Outros" <?php echo ($genero == 'Outros')?'selected':''?>>Outros</option>
                        </select>
                    </div>
                </div>
                <div id="box-button">
                    <input type="submit" value="Atualizar" id="button">
                    <a href="deleteLivro.php?id=<?php echo $id_seg?>" id="excluir"><input type="button" value="Excluir" id="button"></a>
                </div>
            </form>
        </div>
        <a href="../tela-cadastrada/relatorio_livro.php" id="voltar"><img src="../img/voltar.png" alt="voltar"></a>
    </main>
</body>

</html>