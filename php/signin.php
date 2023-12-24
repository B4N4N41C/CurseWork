<?php
session_start();
require 'db.php';
$login = $_POST['login'];
$password = md5($_POST['password']);
$user = selectOne('users', ['Name' => $login]);
if (count($user) > 0 && $user['Password'] === $password) {
    $_SESSION['user'] = [
        "Id" => $user['Id'],
        "Name" => $user['Name'],
        "Photo" => $user['Photo'],
        "Email" => $user['Email'],
        "IsAdmin" => boolval($user['IsAdmin'])
    ];
    header('Location: ../index.php');
} else {
    header('Location: ../html/authorization.php');
}