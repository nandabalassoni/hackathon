<?php
    session_start();
    require_once('db.class.php');
    $user = $_POST['username'];
    $password = md5($_POST['password']);

    // FILTROS
    // ////////////////////////////

    // Linkar ao db
    $db = new db;
    $link = $db->connect_mysql();
    $sql = "SELECT * FROM student WHERE username = '$user' AND password = '$password'";
    
    $resultId = mysqli_query($link, $sql);
    // Consultar
    if($resultId) {
        $userData = mysqli_fetch_array($resultId);
        // var_dump($userData);
        // Validar acesso
        if(isset($userData['username'])) {
            $_SESSION['name'] = $userData['name'];
            header('Location: capacitacao.html');
        } else {
            // Redirecionar usuário
            header('Location: loginEstudante.php?erro=1');
        }
    } else {
        echo "Erro na consulta ao database";
    }
?>