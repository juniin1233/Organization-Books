<?php
    include_once('../coneccao.php');

    session_start();
    
    $id_liv_excluir = $_SESSION['id_liv'];
    $nome_liv = $_SESSION['nome_liv'];
    $autor_liv = $_SESSION['autor_liv'];
    $genero_liv = $_SESSION['genero_liv'];
    $isbn_liv = $_SESSION['ISBN_liv'];

    $sql = "DELETE FROM livros WHERE  id_liv = '$id_liv_excluir'";
    $result = $conexao->query($sql);

    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='shortcut icon' href='../../favicon.ico' type='image/x-icon'>
        <link rel='stylesheet' href='../../style/style.css'>
        <link rel='stylesheet' href='../../style/tela-cadastro.css'>
        <link rel='stylesheet' href='../../style/cadastro.css'>
        <style>
            p{
                text-align: left;
                font-size: 20px;
                color: white;
                margin: 20px;
                text-indent: 25%;
            }
            @media screen and (min-width: 768px) and (max-width: 1324px) { /*Tablet*/
                p{
                    text-indent: 10%;
                }
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
            <h2>Exclusão do Livro Feito com Sucesso</h2>
            <p>Código:<strong>$id_liv_excluir</strong></p>
            <p>Nome:<strong>$nome_liv</strong></p>
            <p>Autor:<strong>$autor_liv</strong></p>
            <p>Gênero:<strong>$genero_liv</strong></p>
            <p>ISBN:<strong>$isbn_liv</strong></p>
            <div id='box-button'>
                <a href='../../tela-cadastro/cadastro_livro.php' class='button'>
                    <img src='../../img/icon_add.png' alt='livro com um '+' que significa cadastrar um novo livro'>
                    <figcaption class='legenda'>Cadastrar<br>Novamente</figcaption>
                </a>
            </div>
        </div>
    </main>
    </body>
    </html>
    ";
?>