<?php

$targetDirectory = "uploads/"; // Директория для сохранения загруженных файлов
$targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]); // Полный путь к файлу

// Сохранение файла на сервере
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    // Файл успешно сохранен на сервере
    // Сохранение пути к файлу в базе данных
    $filePathInDatabase = $targetFile; // Пример: сохранение пути к файлу в базе данных
    // Далее выполните код для сохранения $filePathInDatabase в вашей базе данных
} else {
    // Обработка ошибки сохранения файла
    echo "Sorry, there was an error uploading your file.";
}
?>