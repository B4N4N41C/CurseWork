<?php
session_start();
if (!isset($_SESSION['user']["IsAdmin"]) || $_SESSION['user']["IsAdmin"] !== true) {
    header('Location: ../index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap-grid.css">
    <title>Title</title>
</head>

<body>
    <div class="container">
        <div class="row">
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
        </div>
        <div class="row">
            <div class="col-12 input-section">
                <form action="../php/games.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <b>Введите название игры</b>
                    <br>
                    <input type="text" id="name-game" name="name">
                    <br>
                    <b>Введите описания игры</b>
                    <br>
                    <input type="text" id="summary-game" name="summary">
                    <br>
                    <b>Оценка на Metacritic от критиков</b>
                    <br>
                    <input type="text" id="metacritic-mark-pro" name="metacritic-mark-pro">
                    <br>
                    <b>Оценка на Metacritic от пользователей</b>
                    <br>
                    <input type="text" id="metacritic-mark-users" name="metacritic-mark-users">
                    <br>
                    <b>Оценка на StopGame от критиков</b>
                    <br>
                    <input type="text" id="stopgame-mark-pro" name="stopgame-mark-pro">
                    <br>
                    <input type="submit" value="Добавить игру" name="submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>