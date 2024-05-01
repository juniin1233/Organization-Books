<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/botao.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Organization Books</title>
    <style>
        p{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <main>

        <!-- Fundo Padrão de Todas as Telas -->
        
        <div id="tela_principal">
            <div id="img"></div>
        </div>

        <!-- Parte do Corpo -->

        <div id="div_main">
            <h1>Organization Books</h1>
            <div id="button">
                <button class="button" id="cadastrar_button">
                    <a href="alugueis_pedentes.php" ><p>Alugueis Pedentes</p></a>
                </button>
                <button class="button" id="alugar_button">
                    <a href="registro_alugueis.php"><p>Registro de Alugueis</p></a>
                </button>
            </div>
        </div>
        
        
    </main>
    <a href="../tela_alugar.php" id="voltar"><img src="../img/voltar.png" alt="voltar"></a>
</body>

</html>