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
        <!-- Модальное окно -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Добавить подборку</h2>
                <form id="collectionForm" action="../php/myCollectionDB.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                    <label for="collectionName">Название:</label>
                    <input type="text" id="collectionName" name="collectionName" required>
                    <label for="collectionDescription">Описание:</label>
                    <textarea id="collectionDescription" name="collectionDescription" required></textarea>
                    <input type="submit" value="Добавить подборку" id="submitCollection" name="submit">
                </form>
            </div>
        </div>
        <div id="confirm-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Добавить подборку</h2>
                <form id="confirmForm" action="../php/publicCollection.php" method="post">
                    Уверены что хотите опубликовать запись?
                    <input type="text" name="public-collection" value="" class="publicCollection__input-hidden">
                    <input type="submit" value="Опубликовать запись" id="submitConfirm" name="submit">
                </form>
            </div>
        </div>
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
            $collections = selectAll('collection'); // Предполагается, что у вас есть функция selectAll, возвращающая данные из базы
            foreach ($collections as $collection) {
                echo generateCollectionHTML($collection);
            }
            ?>
            <div class="col-md-6 col-12">
                <div class="game-collection">
                    <img class="img-game" src="../img/video-igry-red-dead-redemption-2-action.jpg" alt="house">
                    <div class="public-collection"><i class="fa-light fa-globe"></i></div>
                    <br>
                    <div class="game__info">
                        <b class="game-collection__info-text">Red Dead Redemption 2</b>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 add-collection">
                <div class="add-collection__text">Добавить подборку <i class="fa-solid fa-plus"></i></div>
            </div>
        </div>
    </div>
    <script src="/js/addCollection.js"></script>
    <script src="/js/publicCollection.js"></script>
</body>
</html>