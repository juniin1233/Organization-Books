<?php

    include_once("../backend/coneccao.php");

    $id = $_GET['id'];

    $sql = "SELECT * FROM alugueis WHERE id_aluguel=$id";
    $localizar = mysqli_query($conexao, $sql) or die(mysql_error()); 
    $dados = mysqli_fetch_array($localizar);
    
    
    $id_liv = $dados["cod_liv"];
    $id_leitor = $dados['cod_leitor'];
    $dt_retirada = $dados['dt_retirada'];

    $sqlProcurar = "SELECT lvr.liv_nome, ltr.leitor_nome FROM livros AS lvr, leitores AS ltr WHERE lvr.id_liv='$id_liv' AND ltr.id_leitor='$id_leitor'";
    $localizar = mysqli_query($conexao, $sqlProcurar) or die(mysql_error()); 
    $dados = mysqli_fetch_array($localizar);

    $nome_livro = $dados['liv_nome'];
    $nome_leitor = $dados['leitor_nome'];

    $hoje = date('Y-m-d'); 

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/tela-cadastro.css">
    <link rel="stylesheet" href="../style/botao.css">
    <link rel="stylesheet" href="../style/cadastro.css">
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
            <h2>Devolução de Livros</h2>
            <form action="devolucao.php?id=<?php echo $id?>" method="post">
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="leitor" class="inputUser" value="<?php echo $nome_leitor?>" required>
                        <label for="nome" class="labelInput">Leitor</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="livro" class="inputUser" value="<?php echo $nome_livro?>" required>
                        <label for="nome" class="labelInput">Livro</label>
                    </div>
                </div>

                <div class="box">
                    <div class="inputBox">
                        <input type="date" name="dt_retirada" class="inputUser" id="data-field" min="2023-06-18" value="<?php echo $dt_retirada?>" required>
                        <label for="nome" class="labelInput">Data Retirada</label>
                    </div>
                    <div class="inputBox">
                        <input type="date" name="dt_entrega" class="inputUser" id="data-field" min="2023-06-18" value="<?php echo $hoje?>"required>
                        <label for="nome" class="labelInput">Data Devolução</label>
                    </div>
                </div>
                <div id="box-button">
                    <input type="submit" value="Salvar" id="button">
                </div>
            </form>
        </div>
    </main>
    <a href="alugueis_pedentes.php" id="voltar"><img src="../img/voltar.png" alt="voltar"></a>
    <a href="registro_alugueis.php" id="relatorio">
        <img src="../img/livros-relatorios.png" alt="feito">
    </a>
</body>

</html>