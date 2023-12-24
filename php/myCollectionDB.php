<?php
session_start();
require  'db.php';
$isSubmit = false;
$errorMessage = '';
$filePathInDatabase = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDirectory = "../imgCollection/"; // Директория для сохранения загруженных файлов
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
    $collectionName = trim($_POST['collectionName']);
    $collectionDescription = trim($_POST['collectionDescription']);
    if ($collectionName === '' || $collectionDescription === '') {
        $errorMessage = 'Не все поля заполнены';
    } else {
        $post = [
            'Name' => $collectionName,
            'Summary' => $collectionDescription,
            'Photo' => $filePathInDatabase
        ];
        insert('collection', $post);
        $selectCollection = selectOne('collection', $post);

        $postForUserCollection = [
            'IdCollection' => $selectCollection['IdCollection'],
            'IdUser' => ($_SESSION['user']["Id"])
        ];
        insert('userCollection', $postForUserCollection);
    }
    header('Location: ../html/myCollection.php');
}








// // Получение данных от клиента
// $collectionName = $_POST['collectionName'];
// $collectionDescription = $_POST['collectionDescription'];

// // Вставка данных в базу данных
// $insertData = [
//     'Name' => $collectionName,
//     'Summary' => $collectionDescription
//     // Другие поля, если они есть
// ];

// // Вызов вашей функции вставки данных в базу данных (предположим, что она называется insert)
// insert('collection', $insertData);

// // Ответ сервера
// echo "Подборка успешно добавлена в базу данных!";
