<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ponto</title>
    <link rel="shortcut icon" href="./images/guia-payroll.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/Fonts.css">
    <link rel="stylesheet" href="./styles/regponto.css">
</head>
<body>
    <div>
        <img class="fundo-img" src="./images/fundo-payroll.jpg" alt="imagem de fundo do site">
    </div>
    <header class="cabecalho" id="cabecalho">
        <a href="#" class="logo">
            <img alt="PayrollPro" title="PayrollPro" src="./images/guia-payroll.png" class="logo-img">
            <h1>PayrollPro</h1>
        </a>
        <nav>
            <ul class="menu">
                <li><a href="./regponto.php">Sistema de Ponto</a></li>
                <li><a href="./requerimento.html">Solicitar Férias</a></li>
                <li><a href="./demonstrativo.html">Demonstrativo de Férias</a></li>
                <li><a class="btn-sair" href="./login.html"><img class="sair-img" src="./images/sair.png"> Sair</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <div class="imagem-ponto">
            <img src="./images/imagem-folha-ponto.png" alt="Imagem ilustrativa de alguem batendo ponto" class="img-ptn">
        </div>
        <div class="form__dem">
            <h1>Sistema de Ponto</h1><br><hr><br>

            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            
            <p id="horario"><?php echo date ("d/m/Y H:i:s")?></p>
            <button class="form-btn"><a href="registrar_ponto.php">Bater Ponto</a></button><br>
            <button class="form-btn"><a href="registrar_ponto.php">Consultar Ponto</a></button><br>
            <?php 

            include_once("conexao.php");

            $query_horarios = "SELECT data_entrada, entrada, saida_intervalo, retorno_intervalo, saida, usuario_id FROM ponto ORDER BY id DESC";

            $result_horarios = $conn->prepare($query_horarios);
            $result_horarios->execute();

            while($row_horario = $result_horarios->fetch(PDO::FETCH_ASSOC)){
                extract($row_horario);
                // var_dump($row_horario);
                echo "Data de Cadastro: $data_entrada <br>";
                echo "Registro de Ponto: $entrada <br>";
                echo "Registro de Ponto: $saida_intervalo <br>";
                echo "Registro de Ponto: $retorno_intervalo <br>";
                echo "Registro de Ponto: $saida <br>";
                echo "Funcionário: ";

                break 1;
            }

            // Converte os dois horarios para um objeto DateTime do PHP
            $entrada = DateTime::createFromFormat('H:i:s', $entrada);
            $saida = DateTime::createFromFormat('H:i:s', $saida);

            // diff - Retorna a diferença entre dois objetos DateTime
            $intervalo = $entrada->diff($saida);

            // Formata a diferença entre horarios
            echo $intervalo->format('%H:%I:%S');

            
            ?>
            <div id="output"></div>
        </div>
        <script src="./js/script.js"></script>
    </main>
</body>
</html>