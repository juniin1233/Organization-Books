<?php

    $id = $_POST['identificacao'];
    $nome_liv = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $edicao = $_POST['edicao'];
    $isbn = $_POST['isbn'];
    if(empty($_POST['genero'])){
        $genero = '';   
    }else{
        $genero = $_POST['genero'];
    }

    // Criando conexão com servidor e banco de dados
    include_once('coneccao.php');

    // Conferir autor

        $conferirAutor = "SELECT * FROM autores WHERE nome = '$autor'";
        $localizarAutor = mysqli_query($conexao, $conferirAutor) or die (mysql_error());
        $registroAutor = mysqli_num_rows($localizarAutor);	
        if($registroAutor == 0){
            header("Location: autor-erro.php");
        }

    // Conferir editora
        $conferirEditora = "SELECT * FROM editora WHERE nome = '$editora'";
        $localizarEditora = mysqli_query($conexao, $conferirEditora) or die (mysql_error());
        $registroEditora = mysqli_num_rows($localizarEditora);	
        if($registroEditora == 0){
            header("Location: editora-erro.php");
        }
    $sql = "select * from livros where id_liv = '$id'";
    $localizarUsuario = mysqli_query($conexao, $sql) or die(mysql_error());
    $registro = mysqli_num_rows($localizarUsuario);
    if ($registro == 0 && $registroAutor != 0 && $registroEditora != 0) {
        
        session_start();
        $_SESSION['id_liv'] = $id;
        $_SESSION['nome_liv'] = $nome_liv;
        $_SESSION['autor_liv'] = $autor;
        $_SESSION['editora_liv'] = $editora;
        $_SESSION['ISBN_liv'] = $isbn;
        $_SESSION['genero_liv'] = $genero;
        
        // Salvando no banco de dados
        $sql = "INSERT INTO livros (id_seg, id_liv, liv_nome, liv_autor, liv_editora, liv_edicao, isbn, liv_genero) VALUES (null, '$id', '$nome_liv', '$autor', '$editora', '$edicao', '$isbn', '$genero')";
        $salvar = mysqli_query($conexao, $sql) or die(mysql_error());
        
        // Tela caso o cadastro seja feito com sucesso
        echo "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
            <link rel='stylesheet' href='../style/style.css'>
            <link rel='stylesheet' href='../style/tela-cadastro.css'>
            <link rel='stylesheet' href='../style/cadastro.css'>
            <style>
            a#voltar img{
                width: 65px;
                height: 65px;
                position: absolute;
                top: 80px;
                left: 100px;
            
                transition: .5s;
            } 
            
            a#voltar img:hover{
                transform: scale(1.3);
            }
                p{
                    text-align: left;
                    font-size: 20px;
                    color: white;
                    margin: 20px;
                }
                strong{
                    margin-left: 10px;
                    text-decoration: underline;
                }

                h2{
                    margin-bottom: 50px;
                }
         
                a{
                    text-decoration: none;
                }

                .button{
                    margin-top: 20px;
                    padding: 0 60px;
                    width: auto;
                    box-shadow: none;
                    transition: .5s;
                }
                
                .legenda{
                    color: white;
                    font-size: 18px;
                    font-family: 'Inter';
                    text-align: center;
                    text-decoration: none;
                    display: none;
                }
                .button img{
                    width: 100px;
                    height: 100px;

                }
                .button:hover{
                    transform: scale(1.1);
                    
                }   
                
                .button:hover .legenda{
                    display: block;        
                }
                #teste{
                    text-align: center;
                }
            </style>
            <link rel='stylesheet' href='../style/mediaqueries.css'>
            <style>
            @media screen and (min-width: 768px) and (max-width: 1324px) { /*Tablet*/
                #div_main{
                    padding: 0;
                }
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
                <h2>Cadastro Feito com Sucesso</h2>
                <p>Código:<strong>$id</strong></p>
                <p>Nome:<strong>$nome_liv</strong></p>
                <p>Autor:<strong>$autor</strong></p>
                <p>Editora:<strong>$editora</strong></p>
                <p>Edição:<strong>$edicao</strong></p>
                <p>Gênero:<strong>$genero</strong></p>
                <p>ISBN:<strong>$isbn</strong></p>
                <a href='../tela_alugar.php?livro=$id'><p id='teste'>Deseja fazer um aluguel nesse livro</p></a>
                <div id='box-button'>
                    <a href='exclusao/excluir_livro.php' class='button'>
                        <img src='../img/icon_delete.png' alt='livro com um 'X' que significa deletar o livro digitado'>
                        <figcaption class='legenda'>Excluir</figcaption>
                    </a>
                    <a href='../tela-cadastro/cadastro_livro.php' class='button'>
                        <img src='../img/icon_add.png' alt='livro com um '+' que significa cadastrar um novo livro'>
                        <figcaption class='legenda'>Cadastrar<br>Novamente</figcaption>
                    </a>
                </div>
            </div>
        </main>
        <a href='../tela_cadastro.html' id='voltar'><img src='../img/voltar.png' alt='voltar'></a>
        </body>
        </html>

      
            ";
    } else {
        // Conectando com o Banco
        include_once('coneccao.php');

        // Buscando dados do livro que será excluido
        $livroSQL = "SELECT * FROM livros WHERE id_liv = '$id'";
        $localizarLivro = mysqli_query($conexao, $livroSQL) or die (mysql_error());
        $dados = mysqli_fetch_array($localizarLivro);

        session_start();
        unset($_SESSION['id_liv']);
        unset($_SESSION['nome_liv']);

        $_SESSION['id_liv'] = $dados['id_liv'];
        $_SESSION['nome_liv'] = $dados['liv_nome'];
        $_SESSION['autor_liv'] = $dados['liv_autor'];
        $_SESSION['editora_liv'] = $dados['liv_editora'];
        $_SESSION['ISBN_liv'] = $dados['isbn'];
        $_SESSION['genero_liv'] = $dados['liv_genero'];
        
        // Tela caso o cadastro tenha dado erro
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
                    
                    a#voltar img{
                        width: 65px;
                        height: 65px;
                        position: absolute;
                        top: 80px;
                        left: 100px;
                    
                        transition: .5s;
                    } 
                    
                    a#voltar img:hover{
                        transform: scale(1.3);
                    }
                        p{
                            text-align: center;
                            font-size: 20px;
                            color: white;
                            margin: 20px;
                        }
                        strong{
                            text-decoration: underline;
                        }

                        h2{
                            margin-bottom: 50px;
                        }
                a{
                    text-decoration: none;
                }

                .button{
                    margin-top: 50px;
                    padding: 10px 60px;
                    width: auto;
                    box-shadow: none;
                    transition: .5s;
                }
                
                .legenda{
                    color: white;
                    font-size: 18px;
                    font-family: 'Inter';
                    text-align: center;
                    text-decoration: none;
                    display: none;
                }
                .button img{
                    width: 100px;
                    height: 100px;

                }
                .button:hover{
                    transform: scale(1.1);
                    
                }   
                
                .button:hover .legenda{
                    display: block;        
                }
                    </style>
                    <title>Organization Books</title>
                    
                    <link rel='stylesheet' href='../style/mediaqueries.css'>
                    <style>
                    @media screen and (min-width: 768px) and (max-width: 1324px) { /*Tablet*/
                        #div_main{
                            padding: 0;
                        }
                        a#voltar img{
                            top: 80px;
                            left: 40px;
                        }
                    }
                    </style>
                    
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
                        <p>Infelizmente já existe um livro com o codigo <strong>$id</strong></p>
                        <p>Cadastre novamente</p>
                        <div id='box-button'>
                            <a href='exclusao/excluir_livro.php' class='button'>
                                <img src='../img/icon_delete.png' alt='livro com um 'X' que significa deletar o livro digitado'>
                                <figcaption class='legenda'>Excluir</figcaption>
                            </a>
                            <a href='../tela-cadastro/cadastro_livro.php' class='button'>
                                <img src='../img/icon_add.png' alt='livro com um '+' que significa cadastrar um novo livro'>
                                <figcaption class='legenda'>Cadastrar<br>Novamente</figcaption>
                            </a>
                        </div>
                    </div>
                    </main>
                    <a href='../tela_cadastro.html' id='voltar'><img src='../img/voltar.png' alt='voltar'></a>
                </body>
                </html>
                ";
    }
?>