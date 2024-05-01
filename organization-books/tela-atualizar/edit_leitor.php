
<?php

    include_once("../backend/coneccao.php");

    $id_seg = $_GET['id'];

    $sql = "SELECT * FROM leitores WHERE id_seg=$id_seg";
    $localizar = mysqli_query($conexao, $sql) or die(mysql_error());
    $registro = mysqli_num_rows($localizar);    

    if($registro == 1){
        while($row = mysqli_fetch_assoc($localizar)){
            $id = $row['id_leitor'];
            $nome = $row['leitor_nome'];
            $cargo = $row['leitor_aluno_prof'];
            $tel = $row['leitor_tel'];
            $email = $row['leitor_email'];
        }
    }
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/tela-cadastro.css">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../style/botao.css">
    <style>
        select option {
            color: #fff;
            background-color: #593f1e;

        }
        form{
            margin-top: 80px;
        }

        #button{
            margin-left: 10px;
        }

        a#excluir{
            text-decoration: none;
        }
    </style>

    <title>Organization Books</title>
</head>

<body>
    <!-- Documentação da Máscara -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <main>

        <!-- Fundo Padrão de Todas as Telas -->

        <div id="tela_principal">
            <div id="img"></div>
        </div>

        <!-- Parte do Corpo -->

        <div id="div_main">
            <h1>Organization Books</h1>
            <h2>Atualização de Leitores</h2>
            <form action="updateLeitor.php?id=<?php echo $id_seg?>" method="post">
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="identificacao" class="inputUser" value="<?php echo $id?>" required>
                        <label class="labelInput">RA ou RG</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="nome" class="inputUser" value="<?php echo $nome?>" required>
                        <label class="labelInput">Nome</label>
                    </div>
                </div>
                <div class="box">
                    <div class="inputBox">
                        <input type="text" name="celular" class="inputUser" id="celular" value="<?php echo $tel?>" required>
                        <label class="labelInput">Celular</label>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" class="inputUser" value="<?php echo $email?>" required>
                        <label class="labelInput">E-mail</label>
                    </div>
                </div>
                <div class="box" id="box-meio">
                    <div class="inputBox">
                        <select name="al_pro" class="inputUser">
                            <option value="Professor" disabled <?php echo $cargo == ''?'selected':''?>> Professor ou Aluno</option>
                            <option value="Professor" <?php echo $cargo == 'Professor'?'selected':''?>>Professor</option>
                            <option value="Aluno" <?php echo $cargo == 'Aluno'?'selected':''?>>Aluno</option>
                        </select>
                    </div>
                </div>
                <div id="box-button">
                    <input type="submit" value="Atualizar" id="button">
                    <a href="deleteLeitor.php?id=<?php echo $id_seg?>" id="excluir"><input type="button" value="Excluir" id="button"></a>
                </div>
            </form>
        </div>
    </main>
    <a href="../tela-cadastrada/relatorio_leitor.php" id="voltar"><img src="../img/voltar.png" alt="voltar"></a>
    <!-- Máscara do Telefone -->
    <script type="text/javascript">
        $("#celular").mask("(00) 00000-0000");
    </script> 
</body>

</html>
