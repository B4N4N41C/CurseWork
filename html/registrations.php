<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/authorization.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>HASH TECHIE OFFICIAL</title>
</head>
<body>
<header class="col-12">
    <a href="#" class="logo">MyGame</a>
    <nav class="navbar">
        <a href="../index.php" class="navbar__item">Игры</a>
        <a href="/html/collection.php" class="navbar__item">Подборки</a>
        <a href="/html/myCollection.php" class="navbar__item">Мои подборки</a>
        <?php
        if (isset($_SESSION['user']["IsAdmin"]) && $_SESSION['user']["IsAdmin"] === true) {
            echo '<a href="/html/add-an-entry.php" class="navbar__item">Добавить запись</a>';
        }
        ?>
        <?php
        if (isset($_SESSION['user'])) {
            echo '<a href="/php/logout.php" class="navbar__item">Выйте</a>';
        } else {
            echo '<a href="/html/authorization.php" class="navbar__item">Авторизация</a>';
        }
        ?>
    </nav>
</header>
<section>
    <div class="form-box">
        <div class="form-value">
            <form action="../php/singup.php" method="post" enctype="multipart/form-data">
                <h2>Регистрация</h2>


                <div class="inputbox">
                    <input type="text" name="login">
                    <label>Логин</label>
                </div>
                <input style="color: #eeeeee" type="file" name="avatar">
                <div class="inputbox">
                    <input type="email" name="email">
                    <label>Электронная почта</label>
                </div>
                <div class="inputbox">
                    <input type="password" name="password">
                    <label>Пороль</label>
                </div>
                <div class="inputbox">
                    <input type="password" name="password_confirm">
                    <label>Повторите пороль</label>
                </div>
                <button>Заркгистрироваться</button>
                <div class="register">
                    <p>Есть аккаунт? <a href="authorization.php">Войти</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>