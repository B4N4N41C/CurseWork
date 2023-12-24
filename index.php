<?php
    session_start();

    include "./php/addGameToCollection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/iconsfont.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div class="container">
        <!-- Одно общее модальное окно -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <!-- Контент вашего модального окна -->
                <span class="close">&times;</span>
                <?php
                $collections = selectAll('collection'); // Предполагается, что у вас есть функция selectAll, возвращающая данные из базы
                foreach ($collections as $collection) {
                    echo generateNameCollectionHTML($collection);
                }
                ?>
                <form class="modal-form" action="index.php" method="post">
                    <input type="text" name="selected-collection" value="" class="collection__input-hidden">
                    <input type="text" name="selected-game" value="" class="game__input-hidden">
                    <input type="submit" value="Добавть подборку" id="submitCollection" name="submit">
                </form>
            </div>
        </div>
        <div class="row">
            <header class="col-12">
                <a href="#" class="logo">MyGame</a>
                <nav class="navbar">
                    <a href="index.php" class="navbar__item">Игры</a>
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
            $games = selectAll('games'); // Предполагается, что у вас есть функция selectAll, возвращающая данные из базы
            foreach ($games as $game) {
                echo generateGameHTML($game);
            }
            ?>

        </div>
    </div>
    <script src="js/modal.js"></script>
    <script type="module" src="js/modalAddToCollection.js"></script>
    <script type="module" src="js/selectCollection.js"></script>
</body>
</html>