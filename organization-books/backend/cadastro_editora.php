<?php

    $editora = $_POST['editora'];

    // Criando conexão com servidor e banco de dados
    $servidorConexao = "localhost";  
    $usuarioConexao = "root";
    $senhaconexao = "";
    $BD = "banco-organization";

    // Codigo de conexâo ao banco
    $conexao = mysqli_connect($servidorConexao, $usuarioConexao, $senhaconexao, $BD) or die (mysql_error());

    $sql = "select * from editora where nome = '$editora'";
    $localizar = mysqli_query($conexao, $sql) or die(mysql_error());
    $registro = mysqli_num_rows($localizar);    

    if($registro == 0){

        session_start();
        $_SESSION['nome_editora'] = $editora;

        $sql = "INSERT INTO editora (id, nome) VALUES (null, '$editora')";
        
        // Salvando no banco de dados
        $salvar = mysqli_query($conexao, $sql) or die(mysql_error());
        echo "<!DOCTYPE html>
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
                text-align: left;
                font-size: 23px;
                color: white;
                margin: 20px;
            }
            strong{
                text-decoration: underline;
                margin-left: 10px;
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
            #teste{
                margin-top: 50px;
                text-align: center;
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
                <p>Editora:<strong>$editora</strong></p>
                <a href='../tela-cadastro/cadastro_livro.php?editora=$editora'><p id='teste'>Cadastrar Um Livro com essa editora</p></a>
                <div id='box-button'>
                        <a href='exclusao/excluir_editora.php' class='button'>
                            <img src='../img/icon_delete.png' alt='livro com um 'X' que significa deletar o livro digitado'>
                            <figcaption class='legenda'>Excluir</figcaption>
                        </a>
                        <a href='../tela-cadastro/cadastro_editora.html' class='button'>
                            <img src='../img/icon_add.png' alt='livro com um '+' que significa cadastrar um novo livro'>
                            <figcaption class='legenda'>Cadastrar<br>Novamente</figcaption>
                        </a>
                </div>
            </div>
           </main>
           <a href='../tela_cadastro.html' id='voltar'><img src='../img/voltar.png' alt='voltar'></a>
        </body>
        </html>";
        
    }else{

        // Conectando com o Banco
        include_once('coneccao.php');

        // Buscando dados do livro que será excluido
        $livroSQL = "SELECT * FROM editora WHERE nome = '$editora'";
        $localizarLivro = mysqli_query($conexao, $livroSQL) or die (mysql_error());
        $dados = mysqli_fetch_array($localizarLivro);

        session_start();
        unset($_SESSION['nome_editora']);

        $_SESSION['nome_editora'] = $dados['nome'];
       
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
                    font-size: 23px;
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
                <p>Infelizmente já existe uma editora cadastrada no nome de <strong>$editora</strong></p>
                <div id='box-button'>
                    <a href='exclusao/excluir_editora.php' class='button'>
                        <img src='../img/icon_delete.png' alt='livro com um 'X' que significa deletar o livro digitado'>
                        <figcaption class='legenda'>Excluir</figcaption>
                    </a>
                    <a href='../tela-cadastro/cadastro_editora.html' class='button'>
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