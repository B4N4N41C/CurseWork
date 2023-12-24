<?php

session_start();
require "db.php";


$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password === $password_confirm) {

    $path = 'users/' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $_SESSION['message'] = 'Ошибка при загрузке сообщения';
        header('Location: ../html/registrations.php');
    }

    $password = md5($password);

    if ($login === '' || $email === '' || $password === '' || $password_confirm === '') {
        $errorMessage = 'Не все поля заполнены';
    } else {
        $post = [
            'Name' => $login,
            'Email' => $email,
            'Password' => $password,
            'Photo' => $path,
        ];
        insert('users', $post);
        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../html/authorization.php');
    }
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}

