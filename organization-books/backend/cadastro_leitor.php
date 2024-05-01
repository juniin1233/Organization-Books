<?php
    
    $id = $_GET['identificacao'];
    $nome = $_GET['nome'];
    $tell = $_GET['celular'];
    $email = $_GET['email'];
    if(empty($_GET['al_pro'])){
        $al_pro = '';   
    }else{
        $al_pro = $_GET['al_pro'];
    }
    // Criando conexão com servidor e banco de dados
    include_once('coneccao.php');

    $sql = "SELECT * FROM leitores WHERE id_leitor = '$id'";
    $localizarUsuario = mysqli_query($conexao, $sql) or die(mysql_error());
    $registro = mysqli_num_rows($localizarUsuario);
    if($registro == 0){

        session_start();
        $_SESSION['id_leitorSec'] = $id;
        $_SESSION['nome_leitorSec'] = $nome;
        $_SESSION['tell_leitorSec'] = $tell;
        $_SESSION['email_leitorSec'] = $email;
        $_SESSION['ALouPRO_leitorSec'] = $al_pro;
        

        // Salvando os dados no banco
        $sql = "INSERT INTO leitores (id_seg, id_leitor, leitor_nome, leitor_aluno_prof, leitor_tel, leitor_email) VALUES(null, '$id', '$nome', '$al_pro', '$tell', '$email')";
        $salvar = mysqli_query($conexao, $sql) or die (mysql_error());

        // Tela caso o cadastro seja feito com sucesso
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
                text-align: left;
                font-size: 20px;
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
                <p>Código:<strong>$id</strong></p>
                <p>Nome:<strong>$nome</strong></p>
                <p>Celular:<strong>$tell</strong></p>
                <p>E-mail:<strong>$email</strong></p>
                <p>Aluno ou Professor:<strong>$al_pro</strong></p>
                <a href='../tela_alugar.php?leitor=$id'><p id='teste'>Deseja fazer um aluguel para o/a $nome</p></a>
                <div id='box-button'>
                    <a href='exclusao/excluir_leitor.php' class='button'>
                        <img src='../img/icon_delete.png' alt='livro com um 'X' que significa deletar o livro digitado'>
                        <figcaption class='legenda'>Excluir</figcaption>
                    </a>
                    <a href='../tela-cadastro/cadastro_leitor.html' class='button'>
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

    }else{
        // Conectando com o Banco
        include_once('coneccao.php');

        // Buscando dados do livro que será excluido
        $LeitorSQL = "SELECT * FROM leitores WHERE id_leitor = '$id'";
        $localizarLeitor = mysqli_query($conexao, $LeitorSQL) or die (mysql_error());
        $dados = mysqli_fetch_array($localizarLeitor);

        session_start();
        unset($_SESSION['id_leitorSec']);
        unset($_SESSION['nome_leitorSec']);
        unset($_SESSION['tell_leitorSec']);
        unset($_SESSION['email_leitorSec']);
        unset($_SESSION['ALouPRO_leitorSec']);

        $_SESSION['id_leitorSec'] = $dados['id_leitor'];
        $_SESSION['nome_leitorSec'] = $dados['leitor_nome'];
        $_SESSION['tell_leitorSec'] = $dados['leitor_tel'];
        $_SESSION['email_leitorSec'] = $dados['leitor_email'];
        $_SESSION['ALouPRO_leitorSec'] = $dados['leitor_aluno_prof'];

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
                       <p>Leitor já cadastrado</p>
                       <div id='box-button'>
                            <a href='exclusao/excluir_leitor.php' class='button'>
                                <img src='../img/icon_delete.png' alt='livro com um 'X' que significa deletar o livro digitado'>
                                <figcaption class='legenda'>Excluir</figcaption>
                            </a>
                            <a href='../tela-cadastro/cadastro_leitor.html' class='button'>
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