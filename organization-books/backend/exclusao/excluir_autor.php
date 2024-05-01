<?php
    include_once('../coneccao.php');

    session_start();
    
    $nome_autor = $_SESSION['nome_autor'];

    $sql = "DELETE FROM autores WHERE  nome = '$nome_autor'";
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
            <h2>Exclusão de Autor Feito com Sucesso</h2>
            <p>Nome:<strong>$nome_autor</strong></p>
            <div id='box-button'>
                <a href='../../tela-cadastro/cadastro_autor.html' class='button'>
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