<?php
    // Iniciando o session antes de tudo...
    session_start();
    

    // Consulta SQL
        if(empty($_SESSION['filtroOrdem']) && empty($_SESSION['nomePesq'])){
            $filtroOrdem = '';
            $nomePesq = '';
        }else{
            $filtroOrdem = $_SESSION['filtroOrdem'];
            $nomePesq = $_SESSION['nomePesq'];
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

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
        }

        div#tabelaFiltros form#filtro div.caixa {
            margin: 30px 0;
        }

        #col_inf a img:hover {
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
            <h2 id="subTitulo">Registro de Alugueis</h2>
            <h2 id="titulo_print"></h2>

            <div id="tabelaFiltros">
                <form action="filtro.php" id="filtro" method="post">
                    <div class="caixa">
                        <label for="">Ordenar :</label>
                        <select name="ordem" class="selecao">
                            <option value="" selected disabled>Selecione</option>
                            <option value="1">Crescente</option>
                            <option value="2">Decrescente</option>
                        </select>
                    </div>
                    <div class="caixa">
                        <label for="input_pesq">ID Livro :</label>
                        <input type="text" name="nome_pesq" id="input_pesq"
                            value="<?php echo $nomePesq; ?>">
                    </div>
                    <input type="submit" value="Filtrar" id="pesquisar">
                </form>

            </div>
            <?php

            // Exportando a Conecção
            include_once("../backend/coneccao.php");

            // Consulta SQL
            $sql = "SELECT * FROM alugueis WHERE dt_entrega IS NOT NULL AND cod_liv LIKE '%$nomePesq%' ORDER BY id_aluguel " . $filtroOrdem . ""; // Substitua 'tabela' pelo nome da sua tabela
            

            // Quantos dados tem no banco..
            $qtdAluguelsql = "SELECT * FROM alugueis";
            $pesquisaAluguel = mysqli_query($conexao, $sql) or die(mysql_error());
            $qtdAlugueis = mysqli_num_rows($pesquisaAluguel);

            echo "<div class='class' id='qtd'><p>Quantidade de Alugueis Feito: <strong>$qtdAlugueis</strong></p></div>";

            // Executar a consulta e obter os resultados
            $result = $conexao->query($sql);
            
            // print($sql);
            // Verificar se existem dados a serem exibidos
            if ($result->num_rows > 0) {
                // Exibir os dados em uma tabela
            
                echo "
                <table id='myTable'>
                <thead>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Livro</th>
                    <th scope='col'>Leitor</th>
                    <th scope='col'>Data Retirada</th>
                    <th scope='col'>Data Entrega</th>
                    <th score='col' id='teste'></th>
                </tr>
                </thead>
                <tbody>
                ";

                while ($row = $result->fetch_assoc()) {


                    $dt_retirada = $row["dt_retirada"];
                    $dt_entrega = $row["dt_entrega"];
                    $dataRetirada = date('d/m/Y', strtotime($dt_retirada));
                    $dataEntrega = date('d/m/Y', strtotime($dt_entrega));

                    // Fazer uma lógica para pegar o nome do livro e do leitor no banco de dados{
            
                    $id_liv = $row["cod_liv"];
                    $id_leitor = $row["cod_leitor"];

                    // Pegar nome do Livro
                    $conferirLivro = "SELECT * FROM livros WHERE id_liv = '$id_liv'";
                    $localizarLivro = mysqli_query($conexao, $conferirLivro) or die(mysql_error());
                    $registroLivro = mysqli_num_rows($localizarLivro);

                    $dados = mysqli_fetch_array($localizarLivro);

                    $_SESSION['nome_livro'] = $dados['liv_nome'];

                    // Pegar nome do Leitor
                    $conferirLeitor = "SELECT * FROM leitores WHERE id_leitor = '$id_leitor'";
                    $localizarLeitor = mysqli_query($conexao, $conferirLeitor) or die(mysql_error());
                    $registroLeitor = mysqli_num_rows($localizarLeitor);

                    $dados = mysqli_fetch_array($localizarLeitor);
                    $_SESSION['nome_leitor'] = $dados['leitor_nome'];
                    // }
            
                    // if ($row["dt_entrega"] != NULL) {


                        echo "
                        <tr>
                            <td> " . $row["id_aluguel"] . "</td> 
                            <td>" . $_SESSION['nome_livro'] . "</td> 
                            <td>" . $_SESSION['nome_leitor'] . "</td> 
                            <td>" . $dataRetirada . "</td> 
                            <td>$dataEntrega</td> 
                            <td id='col_inf'>
                                    <a href='#'>
                                        <img src='../img/inf.png'>
                                    </a>
                            </td>
                            </tr>";
                    // }
                }
                echo "
                        </tbody>
                        </table>";

            }

            // Fechar a conexão
            $conexao->close();

            ?>
        </div>
    </main>
    <a href="limbo.php" id="voltar"><img src="../img/voltar.png" alt="voltar"></a>
    <a onclick="window.print()" id="imprimir"><img src="../img/impressora.png" alt="impressora"></a>

</body>


</html>