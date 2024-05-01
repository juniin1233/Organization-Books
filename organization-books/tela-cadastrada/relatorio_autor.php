<?php
    // Iniciando o session antes de tudo...
    session_start();

    // Consulta SQL
        if(empty($_SESSION['filtroOrdem']) && empty($_SESSION['nomePesq']) && empty($_SESSION['coluna'])){
            $filtroOrdem = '';
            $nomePesq = '';
            $coluna = '';
        }else if($_SESSION['coluna'] != 'nome'){
            $coluna = 'id';
            $filtroOrdem = $_SESSION['filtroOrdem'];
            $nomePesq = $_SESSION['nomePesq'];
        }else{
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

    <!-- Estilo Imprimir -->
    <link rel="stylesheet" href="../style/print.css" media="print">

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

        #col_inf a img:hover{
            transform: none;
            transition: none;
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
                content: "Relatório de Autores";
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

        table{
            margin: auto;
            margin-bottom: 50px;
        }
    </style>
    <title>Organization Books</title>
</head>

<body id="corpo">
    <main>
        <div id="titulosFixo">
            <h1 id="titulo">Organization Books</h1>
            <h2 id="subTitulo">Relatòrios de Autores</h2>
            <h2 id="titulo_print"></h2>

            <div id="tabelaFiltros">
                <form action="filtro.php" id="filtro" method="post">
                    <div class="caixa">
                        <label for="selecao-tema">Classificar Por :</label>
                        <select name="tema" class="selecao">
                            <option value="1">Livros</option>
                            <option value="2">Editora</option>
                            <option value="3">Leitor</option>
                            <option value="4" selected>Autor</option>
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
                        <label for="input_pesq">Nome Autor :</label>
                        <input type="text" name="nome_pesq" id="input_pesq"
                            value="<?php echo $_SESSION['nomePesq']; ?>">
                    </div>
                    <input type="submit" value="Filtrar" id="pesquisar">
                </form>

            </div>
            <?php

            // Exportando a Conecção
            include_once("../backend/coneccao.php");

            // Consulta SQL
            $filtroOrdem = $_SESSION['filtroOrdem'];
            $coluna = $_SESSION['coluna'];
            $nomePesq = $_SESSION['nomePesq'];
            $sql = "SELECT * FROM autores WHERE $coluna LIKE '%$nomePesq%' ORDER BY " . $coluna . " " . $filtroOrdem . ""; // Substitua 'tabela' pelo nome da sua tabela
            
            // Quantos dados tem no banco..
            $qtdAutorSql = "SELECT * FROM autores";
            $pesquisaAutor = mysqli_query($conexao, $sql) or die(mysql_error());
            $qtdAutor = mysqli_num_rows($pesquisaAutor);

            echo "<div class='class' id='qtd'><p>Quantidade de Autores: <strong>$qtdAutor</strong></p></div>";

            // Executar a consulta e obter os resultados
            $result = $conexao->query($sql);

            // Verificar se existem dados a serem exibidos
            if($result->num_rows > 0){
                // Exibir os dados em uma tabela
              
                echo "
                <table id='myTable'>
                <thead>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Nome do Autor</th>
                    <th score='col' id='teste'></th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td> " . $row["id"] . "</td> 
                        <td>" . $row["nome"] . "</td> 
                        <td id='col_inf'>
                                <a href='../tela-atualizar/edit_autor.php?id=$row[id]'>
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
    <a href="relatorio.html" id="voltar">
        <img src="../img/voltar.png" alt="voltar">
    </a>
    <a onclick="window.print()" id="imprimir">
        <img src="../img/impressora.png" alt="impressora">
    </a>

    
</body>


</html>