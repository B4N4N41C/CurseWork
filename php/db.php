<?php

require('connect.php');

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
//Проверка выполнения запроса к БД
function dbCheckError($query){
    $errInfo = $query->errorInfo();

    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
} 

//Запрос на получение данных одной с таблицы
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";
    
    if (!empty($params)){
        $i = 0;
        foreach($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'" . $value . "'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//Запрос на получение данных одной строки с выбранной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";
    
    if (!empty($params)){
        $i = 0;
        foreach($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'" . $value . "'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

//Запись в таблицу БД
function insert($table, $params){
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value){
        if($i === 0){
            $coll = $coll . $key;
            $mask = $mask . "'" . $value . "'";    
        }else {
            $coll = $coll . ", $key";
            $mask = $mask .  ", '$value". "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId();
}

//Обновление строки в таблице
function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value){
        if($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else{
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }
    //UPDATE `users` SET admin = 0 WHERE id = 2
  
    $sql = "UPDATE $table SET $str WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

//Удаление строки в таблице
function delete($table, $id){
    global $pdo;
    $sql = "DELETE FROM $table WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

function query($querySQL)
{
    global $pdo;
    $sql = $querySQL;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

function generateGameHTML($row) {
    $html = '<div class="col-md-4 col-12 marks">';
    $html .= '<div class="game">';
    $html .= '<img class="img-game" src="' . $row['Photo'] . '" alt="' . $row['Id'] . '">';
    $html .= '<div class="add-to-collection"><i class="fa-solid fa-plus"></i></div>';
    $html .= '<br>';
    $html .= '<div class="game__info">';
    $html .= '<b class="game__info-text">' . $row['Name'] . '</b>';
    $html .= '<br>';
    $html .= '<br>';
    $html .= '<table class="game__table">';
    $html .= '<tr>';
    $html .= '<td></td>';
    $html .= '<td><img class="logo-metacritic" src="img/Metacritic_logo_original.svg.png" alt=""></td>';
    $html .= '<td><img class="logo-stopgame" src="img/stopgame-crew-2-ru-age-of-empires-edicion-definitiva-de-videojuegos-toffen-thumbnail.png" alt=""></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td><i class="fa-solid fa-user"></i></td>';
    $html .= '<td>';
    $html .= '<div class="box-mark">';
    $html .= '<b>' . $row['MetacriticPro'] . '</b>';
    $html .= '</div>';
    $html .= '</td>';
    $html .= '<td>';
    $html .= '<div class="stopgame-mark">';
    $html .= '<svg id="ratings/izum" viewBox="0 0 652 618" width="100%" height="100%">';
    $html .= '<path d="M643.3 366.5A319.7 319.7 0 1 0 24 432.2l619.3-65.7z" style="fill:#2b2e2f"></path>';
    $html .= '<path d="M240.2 40.3c-21-.9-34.7 14.8-40.2 27.1 15.3 20.9 34.3 37.4 46.7 121.3 13.3 105.1-55.9 180.2-97.1 230.2a46726.4 46726.4 0 0 0 122-12.9l127-13.5c4.2-34.1 27.4-62.1 35.9-70.6 28.4-20.4 76.8-62.2 90.2-72.6 13.3-10.3 21.7-32 18-44.3-4.3-14.5-22.2-16.5-22.2-16.5s9.5-21.1 2.2-32.1-23-11.7-23-11.7 9.1-21.6 0-34.7c-7.8-11.2-30.9-7.8-30.9-7.8s12-16.8-5.6-30.4c-19.9-15.5-38.9-1.1-58.6 8.6C385 90 327 137.7 327 137.7s-21.9-60.9-53.7-84a61.3 61.3 0 0 0-33.1-13.4zm-111.9 159-19.6 41.4-45 5 32 30.6-6.7 46.4 38.7-23 40.3 23-7.3-45 32.6-31-44.7-6-20.3-41.4z" style="fill:#fff"></path>
    <path d="M210.9 51.8c-5 4.8-8.7 10.5-11 15.5 15.3 20.9 34.3 37.4 46.7 121.3 13.3 105.7-56.3 180.2-97.4 230.2l28.1-2.9c6.8-7.9 17.5-22.3 31.7-40.9 43.3-57 63.3-117 52.8-204-7.4-61.7-30.7-100.3-50.9-119.2zm411.6 357.7-2.8.1-24.8 2.6c-4.1.4-7 1.5-8.8 3.1-1.8 1.6-2.8 4.7-3 9.1l-1.8 35.2c-.3 4.5.4 7.3 2.1 8.6 1.6 1.3 4.5 1.7 8.6 1.3l24.8-2.6c4.1-.4 7.1-1.4 8.7-3.1 1.8-1.6 2.8-4.7 3-9.1l1.8-35.2c.2-4.5-.5-7.3-2.1-8.6-1.2-1-3-1.4-5.7-1.4zm-51 5.3-12.2 1.3-1.2 22.8-18.8 2 1.2-22.8-12.2 1.3-3 57.2 12.2-1.3 1.2-22.5 18.8-2-1.2 22.5 12.2-1.3 3-57.2zm44.3 7.2c.9 0 1.4 0 1.7.3.4.3.6 1.2.5 2.6l-1.4 27.1c-.1 1.4-.3 2.3-.6 2.6-.4.3-1.2.6-2.6.7l-16.5 1.7c-1.4.1-2.2.1-2.6-.2-.4-.3-.6-1.1-.5-2.6l1.4-27c0-1.5.2-2.4.6-2.7.4-.3 1.2-.6 2.6-.7l16.5-1.7h1zM488 423.6l-12.2 1.3-3 57.2 32-3.4c4.1-.4 7-1.5 8.8-3.1 1.8-1.6 2.8-4.7 3-9.1l.7-13.8c.2-4.5-.5-7.3-2.1-8.6-1.7-1.3-4.5-1.7-8.6-1.3l-19.7 2.1 1.1-21.3zm-23.7 2.4-37.6 4-7.2 40.6a9.2 9.2 0 0 1-1.7 4.1c-.8 1-2 1.5-3.8 1.7l-2.5.3-.6 12 7.7-.8c3.8-.4 6.4-1.4 8-3 1.5-1.6 2.7-4.7 3.5-9.3l6.5-34.6 14.9-1.6-2.4 45.2 12.2-1.3 3-57.3zm-63 6.9-2.9.1-24.9 2.6c-4.1.4-7 1.5-8.8 3.1-1.8 1.6-2.8 4.7-3 9.1l-1.8 35.2c-.3 4.5.5 7.3 2.1 8.6 1.7 1.3 4.5 1.7 8.6 1.3l33.8-3.6.8-11.9-29.7 3.1c-1.4.1-2.2.1-2.6-.2-.4-.3-.6-1.1-.5-2.6l.4-7.1 23.8-2.5c4.1-.4 7-1.5 8.8-3.1 1.8-1.6 2.8-4.7 3-9.1l.7-13c.2-4.5-.5-7.3-2.1-8.6-1.3-1-3.2-1.4-5.8-1.4zm-47.3 4.8-38.5 4-.6 11.9 13.2-1.4-2.4 45.3 12.2-1.3 2.4-45.2 13.1-1.4.6-11.9zm-46.1 4.9-15.4 1.6-18.6 40.5 2.1-38.8-12.2 1.3-3 57.2 15.5-1.6 18.6-40.4-2.1 38.6 12.2-1.3 2.9-57.1zm86.4 2.7c.9 0 1.4 0 1.7.3.4.3.6 1.1.5 2.6l-.3 4.9c-.1 1.5-.3 2.4-.6 2.6-.4.3-1.3.6-2.7.7l-19.6 2.1.4-8c0-1.5.2-2.4.6-2.7.4-.3 1.2-.6 2.6-.7l16.5-1.7h1zm-142 3.1-17.9 1.9-10.4 37.5-7.6-35.6-17.9 1.9-3 57.2 12.2-1.3 1.9-37.2 8.4 36.1 8.6-.9 12.6-41.9-2.2 40.8 12.2-1.3 3.1-57.2zm-60.7 6.3-12.4 1.3-12.7 38.5-11.4-36-13 1.4 17.7 56.3-7.1 20.1 10.7-1.3 28.2-80.3zm311.1.5c.9 0 1.4 0 1.7.3.4.3.5 1.1.4 2.6l-.3 5.7a6.8 6.8 0 0 1-.6 2.8c-.4.3-1.2.6-2.6.7l-15.6 1.6.6-12 15.5-1.6h1zm-373 6.2-2.9.1-21.2 2.2c-4.1.4-7 1.5-8.8 3.1-1.8 1.6-2.8 4.7-3 9.1l-.3 5.1 12.3-1.3.1-1c0-1.4.2-2.4.6-2.7.4-.3 1.2-.6 2.6-.7l12.8-1.3c1.4-.1 2.2-.1 2.6.2.4.3.6 1.2.5 2.6l-.3 4.6c-.1 1.5-.3 2.4-.7 2.7-.4.3-1.3.6-2.6.7l-17.4 1.8-.6 12 17.6-1.8c1.2-.1 2 0 2.3.3.3.3.5 1.2.4 2.6l-.2 4.2c0 1.4-.2 2.4-.6 2.7-.4.3-1.2.6-2.6.7l-12.8 1.3c-1.4.1-2.2.1-2.6-.2-.4-.3-.6-1.1-.5-2.6l.2-1.4-12.3 1.3-.4 5.4c-.3 4.5.4 7.3 2.1 8.6 1.6 1.3 4.5 1.7 8.6 1.3l21.2-2.2c4-.5 7-1.5 8.7-3.2 1.7-1.6 2.7-4.7 2.9-9.1l.5-8.7c.2-4.2-.4-7-1.9-8.4 1.7-1.6 2.7-4.6 2.9-9l.5-9c.2-4.5-.5-7.3-2.1-8.6-1.2-1-3-1.4-5.7-1.4zM83.3 466 68 467.7l-18.6 40.6 2.1-38.8-12.2 1.3-3 57.2 15.5-1.6L70.4 486l-2.1 38.6 12.2-1.3 2.9-57.2zm457.2 51.7-381.2 40.1a288.6 288.6 0 0 0 381.2-40.1z" style="fill:#cb282c"></path>';         
    $html .= '</svg>';
    $html .= '</div>';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td><i class="fa-solid fa-users"></i></td>';
    $html .= '<td>';
    $html .= '<div class="circle-mark">';
    $html .= '<b>' . $row['MetacriticUser'] . '</b>';
    $html .= '</div>';
    $html .= '</td>';
    $html .= '<td></td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}


function generateCollectionHTML($row) {
    $html = '<div class="col-md-6 col-12">';
    $html .= '<div class="game-collection">';
    $html .= '<img class="img-game" src="' . $row['PhotoCollection'] . '" alt="' . $row['IdCollection'] . '">';
    $html .= '<div class="public-collection"><i class="fa-light fa-globe"></i></div>';
    $html .= '<br>';
    $html .= '<div class="game__info">';
    $html .= '<b class="game-collection__info-text">' . $row['Name'] . '</b>';
    $html .= '<br>';
    $html .= '<br>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}

function generateNameCollectionHTML($row) {
    $html = '<div class="select-collection" data-value="' . $row['Id'] . '">' . $row['Name'] . '</div>';
    return $html;
}
