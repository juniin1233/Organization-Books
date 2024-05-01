<?php 
    if(empty($_GET['leitor'])){
        $leitor = '';
    }else{
        $leitor = $_GET['leitor'];
    }

    if(empty($_GET['livro'])){
        $livro = '';
    }else{
        $livro = $_GET['livro'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/tela-cadastro.css">
    <link rel="stylesheet" href="style/botao.css">
    <link rel="stylesheet" href="style/cadastro.css">
    <title>Organization Books</title>
    <style>
        form{
        margin-top: 80px;
        }

        input[type="date"]::-webkit-calendar-picker-indicator{
            cursor: pointer;
            filter: invert(0.8) brightness(100%) sepia(0%) saturate(0%) hue-rotate(240deg);
        }
    </style>
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
            <h2>Alugar</h2>
            <form action="backend/aluguel.php" method="post">
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="leitor" class="inputUser" value="<?php echo $leitor?>" required>
                        <label for="nome" class="labelInput">Leitor</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="livro" class="inputUser" value="<?php echo $livro?>" required>
                        <label for="nome" class="labelInput">Livro</label>
                    </div>
                </div>

                <div class="box" id="box-meio">
                    <div class="inputBox">
                        <input type="date" name="dt_retirada" class="inputUser" id="data-field" min="2023-06-18" required>
                        <label for="nome" class="labelInput"></label>
                    </div>
                </div>
                <div id="box-button">
                    <input type="submit" value="Cadastrar" id="button">
                </div>
            </form>
        </div>
    </main>
    <a href="index.html" id="voltar"><img src="img/voltar.png" alt="voltar"></a>
    <a href="tela-movimentacoes/limbo.php" id="relatorio">
        <img src="img/livros-relatorios.png" alt="feito">
    </a>
</body>

</html>