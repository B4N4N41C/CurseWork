<?php
session_start();
require "../php/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/iconsfont.css">
    <meta charset="UTF-8">
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
            <?php
            $collections = selectAll('collection', ['IsPublic' => 1]); // Предполагается, что у вас есть функция selectAll, возвращающая данные из базы
            foreach ($collections as $collection) {
                echo generateCollectionHTML($collection);
            }
            ?>
            <div class="col-md-6 col-12 marks">
                <div class="game">
                    <img class="img-game" src="../img/video-igry-red-dead-redemption-2-action.jpg" alt="house">
                    <br>
                    <div class="game__info">
                        <b class="game__info-text">Red Dead Redemption 2</b>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>