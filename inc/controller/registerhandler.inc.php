<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/controller/prepareinsert.inc.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $registeruser = new PrepareInsert($username, $email, $password, $level, $pdo);
        $registeruser->prepareExec();

        header("Location: ../../register.php");
    } else {
        header("Location: ../../register.php");
        die();
    }