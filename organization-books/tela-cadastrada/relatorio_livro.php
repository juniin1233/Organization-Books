<?php
// Iniciando o session antes de tudo...
session_start();

// Consulta SQL
if (empty($_SESSION['filtroOrdem']) && empty($_SESSION['nomePesq']) && empty($_SESSION['coluna'])) {
    $filtroOrdem = '';
    $nomePesq = '';
    $coluna = '';
} else if ($_SESSION['coluna'] != 'liv_nome') {
    $coluna = 'id_liv';
    $filtroOrdem = $_SESSION['filtroOrdem'];
    $nomePesq = $_SESSION['nomePesq'];
} else {
    $filtroOrdem = $_SESSION['filtroOrdem'];
    $nomePesq = $_SESSION['nomePesq'];
    $coluna = $_SESSION['coluna'];
}

?>


<!DOCTYPE html>
<html lang="pt-br">
</script>

<head>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">

    <!-- Estilo Padrão da Página -->
    <link rel="stylesheet" href="../style/style.css">

    <!-- Estilo Padrão da Tela Relatório -->
    <link rel="stylesheet" href="../style/relatorios.css">

    <link rel="stylesheet" href="../style/inf.css">
    <link rel="stylesheet" href="../style/cadastro.css">

    <!-- Estilo Botoes e alguns ajustes -->
    <link rel="stylesheet" href="../style/botao.css">

    <!-- Estilo do Filtro do Relatorio -->
    <link rel="stylesheet" href="../style/filtro_relatorio.css">



    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">


    <style>
        input#input_pesq {
            background-color: transparent;
            border: none;
            border-bottom: 3px solid rgba(255, 255, 255, 0.463);
            width: 60%;

            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 20px;
            color: white;
            outline: none;
        }

        div#tabelaFiltros form#filtro div.caixa {
            margin: 30px 0;
        }

        #col_inf a img:hover {
            transform: none;
            transition: none;
        }

        table {
            margin: auto;
            margin-bottom: 50px;
        }

        @media print {
            h2#subTitulo, #teste, #col_inf{
                display: none;
            }

            td, tr{
                font-size: 15px;
                padding: 5px;
            }
            
            h2#titulo_print::before {
                content: "Relatório de Livros";
            }

            tr,
            td,
            th,
            h1,
            h2,
            p {
                font-family: Arial, Helvetica, sans-serif;
                color: black;
            }
        }

        
    </style>
    <title>Organization Books</title>
        <!-- Estilo Imprimir -->
        <link rel="stylesheet" href="../style/print.css" media="print">
</head>

<body id="corpo">
    <main>
        <div id="titulosFixo">
            <h1 id="titulo">Organization Books</h1>
            <h2 id="subTitulo">Relatòrios de Livros</h2>
            <h2 id="titulo_print"></h2>

            <div id="tabelaFiltros">
                <form action="filtro.php" id="filtro" method="post">
                    <div class="caixa">
                        <label for="selecao-tema">Classificar Por :</label>
                        <select name="tema" class="selecao">
                            <option value="1" selected>Livros</option>
                            <option value="2">Editora</option>
                            <option value="3">Leitor</option>
                            <option value="4">Autor</option>
                        </select>
                    </div>
                    <div class="caixa">
                        <label for="">Ordenar :</label>
                        <select name="ordem" class="selecao">
                            <option value="" selected disabled>Selecione</option>
                            <option value="1">A - Z</option>
                            <option value="2">Z - A</option>
                            <option value="3">Crescente</option>
                            <option value="4">Decrescente</option>
                        </select>
                    </div>
                    <div class="caixa">
                        <label for="input_pesq">Livro :</label>
                        <input type="text" name="nome_pesq" id="input_pesq" value="<?php echo $nomePesq; ?>">
                    </div>
                    <input type="submit" value="Filtrar" id="pesquisar">
                </form>

            </div>
            <?php

            // Exportando a Conecção
            include_once("../backend/coneccao.php");

            $sql = "SELECT * FROM livros WHERE $coluna LIKE '%$nomePesq%' ORDER BY " . $coluna . " " . $filtroOrdem . ""; // Substitua 'tabela' pelo nome da sua tabela
            
            // Quantos dados tem no banco..
            $qtdLivrosSql = "SELECT * FROM livros";
            $pesquisaLivros = mysqli_query($conexao, $qtdLivrosSql) or die(mysql_error());
            $qtdLivros = mysqli_num_rows($pesquisaLivros);

            echo "<div class='class' id='qtd'><p>Quantidade de Livros: <strong>$qtdLivros</strong></p></div>";

            // Executar a consulta e obter os resultados
            $result = $conexao->query($sql);




            // Verificar se existem dados a serem exibidos
            if ($result->num_rows > 0) {
                // Exibir os dados em uma tabela
            
                echo "
                <table id='myTable'>
                <thead>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>Autor</th>
                    <th scope='col'>Editora</th>
                    <th scope='col'>Edição</th>
                    <th scope='col'>ISBN</th>
                    <th scope='col'>Gênero</th>
                    <th score='col' id='teste'></th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td> " . $row["id_liv"] . "</td> 
                        <td>" . $row["liv_nome"] . "</td> 
                        <td>" . $row["liv_autor"] . "</td> 
                        <td>" . $row["liv_editora"] . "</td> 
                        <td>" . $row["liv_edicao"] . "</td> 
                        <td>" . $row["isbn"] . "</td> 
                        <td>" . $row["liv_genero"] . "</td> 
                        <td id='col_inf'>
                                <a href='../tela-atualizar/edit_livro.php?id=$row[id_seg]'>
                                    <img src='../img/inf.png'>
                                </a>
                        </td>
                    </tr>";
                }
                echo "
                    </tbody>
                    </table>
                    ";
            }

            // Fechar a conexão
            $conexao->close();

            ?>
        </div>
    </main>
    <a href="relatorio.html" id="voltar"><img
            src="../img/voltar.png" alt="voltar"></a>
    <a onclick="window.print()" id="imprimir"><img src="../img/impressora.png" alt="impressora"></a>


</body>


</html>