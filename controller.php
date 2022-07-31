<?php
    require_once './model.php';
    $db = new Model();

    $arr = $db->testHerokuDB();
    $result = '';
    foreach ($arr as $book) {
        $result .= implode(",", $book);
    }
    echo $result;
?>