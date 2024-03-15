<?php 
    require_once "./inc/controller/prepareinsert.inc.php";
    require_once "./inc/controller/registermessages.inc.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="inc/controller/registerhandler.inc.php" method="POST">
        <label for="nome">Nome: </label>
        <input type="text" name="username">
        <label for="email">Email:</label>
        <input type="email" name="email">
        <label for="senha">Senha</label>
        <input type="password" name="password">
        <select name="level">
            <option value="1">Admin</option>
            <option value="2">Funcionario</option>
        </select>
        <input type="submit">
    </form>

    <?php
        $message = new RegisterMessages();
        if (isset($_SESSION['REGISTER_STATUS'])) {            
            if ($_SESSION['REGISTER_STATUS'] == 'succes') {
                echo $message->getMessageSucces();
                unset($_SESSION['REGISTER_STATUS']);
            } else if ($_SESSION['REGISTER_STATUS'] == 'fail') {
                echo $message->getMessageFail();
                unset($_SESSION['REGISTER_STATUS']);
            }
        }    ?>
</body>
</html>