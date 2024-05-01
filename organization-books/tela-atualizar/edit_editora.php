
<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];

    $sql = "SELECT * FROM editora WHERE id=$id";
    $localizar = mysqli_query($conexao, $sql) or die(mysql_error());
    $registro = mysqli_num_rows($localizar);    

    if($registro == 1){
        while($row = mysqli_fetch_assoc($localizar)){
            $nome = $row['nome'];
        }
    }
?>

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
        form{
            margin-top: 15%;
        }

        #box-meio{
            margin-bottom: 10%;
        }

        #button{
            margin: 0 10px;
        }

        a#excluir{
            text-decoration: none;
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
        <h2>Atualização de Editora</h2>
        <form action="updateEditora.php?id=<?php echo $id?>" method="post">
        <div class="box" id="box-meio">
                <div class="inputBox">
                    <input type="text" name="editora" class="inputUser" value="<?php echo $nome?>"required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
            </div>
            <div id="box-button">
                <input type="submit" value="Atualizar" id="button">
                <a href="deleteEditora.php?id=<?php echo $id?>" id="excluir"><input type="button" value="Excluir" id="button"></a>
            </div>
        </form>
    </div>
   </main>
   <a href="../tela-cadastrada/relatorio_editora.php" id="voltar"><img src="../img/voltar.png" alt="voltar"></a>
</body>
</html>