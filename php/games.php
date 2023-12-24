<?php
require "db.php";

$isSubmit = false;
$errorMessage = '';


$filePathInDatabase = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDirectory = "../uploads/"; // Директория для сохранения загруженных файлов
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]); // Полный путь к файлу
   
    // Сохранение файла на сервере
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        // Файл успешно сохранен на сервере
        // Сохранение пути к файлу в базе данных
        $filePathInDatabase = $targetFile; // Пример: сохранение пути к файлу в базе данных
        //Далее выполните код для сохранения $filePathInDatabase в вашей базе данных
    } else {
        // Обработка ошибки сохранения файла
        echo "Sorry, there was an error uploading your file.";
    }
    $name = trim($_POST['name']);
    $metacriticMarkPro = trim($_POST['metacritic-mark-pro']);
    $metacriticMarkUsers = trim($_POST['metacritic-mark-users']);
    $stopgameMarkPro = trim($_POST['stopgame-mark-pro']);
    $summary = trim($_POST['summary']);
    //$pass = password_hash($_POST['pass-second'], PASSWORD_DEFAULT);
    //$admin = 0;

    if ($name === '' || $metacriticMarkPro === '' || $metacriticMarkUsers === '' || $stopgameMarkPro === '' || $summary === '') {
        $errorMessage = 'Не все поля заполнены';
    } else {
        $post = [
            'Name' => $name,
            'MetacriticPro' => $metacriticMarkPro,
            'MetacriticUser' => $metacriticMarkUsers,
            'StopGame' => $stopgameMarkPro,
            'Summary' => $summary,
            'Photo' => $filePathInDatabase
        ];
        $isSubmit = true;
        insert('games', $post);
    }
    header('Location: ../html/add-an-entry.php');
}
