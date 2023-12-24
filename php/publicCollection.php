<?php
require 'db.php';
//Подключение к базе данных
$isSubmit = false;
$errorMessage = '';

$filePathInDatabase = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collectionId = trim($_POST['public-collection']);
    echo "da";
    if ($collectionId === '') {
        echo 'Не все поля заполнены';
    } else {
        $post = [
            'isPublic' =>  1
        ];
        $isSubmit = true;
        echo $collectionId;
        update('collection', $collectionId, $post);
    }
    header('Location: ../html/myCollection.php');
}
