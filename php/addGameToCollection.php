<?php
include "db.php";
$isSubmit = false;
$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedCollection = trim($_POST['selected-collection']);
    $selectedGame = trim($_POST['selected-game']);
    if ($selectedCollection === '') {
        $errorMessage = 'Не все поля заполнены';
    } else {
        $isSubmit = true;
        $post = [
            'IdGame' => $selectedGame,
            'IdCollection' => $selectedCollection
        ];
        insert('collectionGame', $post);
    }
}