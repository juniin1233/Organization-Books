<?php

    $livro = $_POST['livro'];
    $leitor = $_POST['leitor'];
    $dt_retirada = $_POST['dt_retirada'];
    $dataFormatada = date('d-m-Y', strtotime($dt_retirada));

    // Entrega
    // Pegando a data do sistema e acrescentado 15 dias e depois formantando para mostrar na tela
    $data = new DateTime();
    $dataNova =  $data->modify('+15 days');
    

    // Apenas para mostrar na dela formatada
    $dataEntrega = $data->format('d/m/Y');

    // Criando conexão com servidor e banco de dados
    $servidorConexao = "localhost";  
    $usuarioConexao = "root";
    $senhaconexao = "";
    $BD = "banco-organization";

    // Codigo de conexâo ao banco
    $conexao = mysqli_connect($servidorConexao, $usuarioConexao, $senhaconexao, $BD) or die (mysql_error());

    // Pegar nome do Livro
    $conferirLivro = "SELECT * FROM livros WHERE id_liv = '$livro'";
    $localizarLivro = mysqli_query($conexao, $conferirLivro) or die (mysql_error());
    $registroLivro = mysqli_num_rows($localizarLivro);	
    
    if($registroLivro == 0){
        header("Location: livro-erro.php");
    }else{
        $dados = mysqli_fetch_array($localizarLivro);
        session_start();
        $_SESSION['nome_livro'] = $dados['liv_nome'];
        $_SESSION['nome_autor'] = $dados['liv_autor'];
    }

    // Pegar nome do Leitor
    $conferirLeitor = "SELECT * FROM leitores WHERE id_leitor = '$leitor'";
    $localizarLeitor = mysqli_query($conexao, $conferirLeitor) or die (mysql_error());
    $registroLeitor = mysqli_num_rows($localizarLeitor);	
    if($registroLeitor == 0){
        header("Location: leitor-erro.php");
    }else{
        $dados = mysqli_fetch_array($localizarLeitor);
        $_SESSION['nome_leitor'] = $dados['leitor_nome'];
    }

    // Se o leitor e o livro não esta cadastrado, não tem porquê salvar no banco!!

    if($registroLivro != 0 && $registroLeitor != 0){
        
        // Conferindo se no banco de dados está alugado tal livro
        $sql = "SELECT * FROM alugueis WHERE dT_entrega IS NULL AND cod_liv = '$livro'";
        $localizarUsuario = mysqli_query($conexao, $sql) or die(mysql_error());
        $registro = mysqli_num_rows($localizarUsuario);

        if($registro == 0){
            $sql = "INSERT INTO `alugueis` (`id_aluguel`, `cod_liv`, `cod_leitor`, `dt_retirada`, `dt_entrega`) VALUES (NULL, '$livro', '$leitor', '$dt_retirada', null);";
            $salvar = mysqli_query($conexao, $sql) or die(mysql_error());

            // Tela caso o aluguel seja feito com sucesso
            echo "
            <!DOCTYPE html>
            <html lang='pt-br'>
            
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='shortcut icon' href='../favicon.ico' type='image/x-icon'>
                <link rel='stylesheet' href='../style/style.css'>
                <link rel='stylesheet' href='../style/tela-cadastro.css'>
                <link rel='stylesheet' href='../style/cadastro.css'>
                <style>
                    p {
                        text-align: left;
                        font-size: 25px;
                        color: white;
                        margin: 20px;
                    }
            
                    strong {
                        text-decoration: underline;
                        margin: 0 8px;
                    }
            
                    h2 {
                        margin-bottom: 50px;
                    }
            
                    #button {
                        margin-top: 50px;
                        padding: 0 15px;
                        width: auto;
                    }
            
                    #button a {
                        text-decoration: none;
                        color: white;
                    }
                </style>
                <title>Organization Books</title>
            </head>
            
            <body>
            
            
                <main>
            
                    <!-- Fundo Padrão de Todas as Telas -->
            
                    <div id='tela_principal'>
                        <div id='img'></div>
                    </div>
            
                    <!-- Parte do Corpo -->
            
                    <div id='div_main'>
                        <h1>Organization Books</h1>
                        <h2>Aluguel Feito com Sucesso</h2>
                        <p>Livro: <strong>" .$_SESSION['nome_livro']. "</strong> - <strong>". $_SESSION['nome_autor']. "</strong></p>
                        <p>Leitor: <strong>".$_SESSION['nome_leitor'] ."</strong></p>
                        <p>Data de Retirada: <strong>$dataFormatada</strong></p>
                        <p>Data de máxima de Entrega: <strong>$dataEntrega</strong></p>
                        <div id='box-button'>
                            <button  id='button'><a href='../tela_alugar.php'>Alugar Novamente</a></button>
                        </div>
                    </div>
                </main>
            </body>
            
            </html>";
        }else{
            
            // Tela caso o aluguel tenha dado erro
            echo "
                    <!DOCTYPE html>
                    <html lang='pt-br'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <link rel='shortcut icon' href='../favicon.ico' type='image/x-icon'>
                        <link rel='stylesheet' href='../style/style.css'>
                        <link rel='stylesheet' href='../style/tela-cadastro.css'>
                        <link rel='stylesheet' href='../style/cadastro.css'>
                    
                        <style>
                            p{
                                text-align: center;
                                font-size: 20px;
                                color: white;
                                margin: 20px;
                            }
                            strong{
                                text-decoration: underline;
                                margin: 0 8px;
                            }

                            h2{
                                margin-bottom: 50px;
                            }

                            #button{
                                margin-top: 50px;
                                padding: 0 15px;
                                width: auto;
                            }
                    
                            #button a{
                                text-decoration: none;
                                color: white;
                            }
                        </style>
                        <title>Organization Books</title>
                    </head>
                    <body>
                        <main>
                    
                        <!-- Fundo Padrão de Todas as Telas -->
                    
                        <div id='tela_principal'>
                            <div id='img'></div>
                        </div>
                    
                        <!-- Parte do Corpo -->
                    
                        <div id='div_main'>
                            <h1>Organization Books</h1>
                            <h2>Erro</h2>
                            <p>O livro <strong>".$_SESSION['nome_livro']."</strong> já está alugado</p>
                            <div id='box-button'>
                                <button  id='button'><a href='../tela_alugar.php'>Tente Novamente</a></button>
                            </div>
                        </div>
                        </main>
                    </body>
                    </html>
                    ";
        }
    }
?>