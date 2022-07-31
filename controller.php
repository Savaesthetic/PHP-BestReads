<?php
    require_once './model.php';
    $db = new Model();

    $something = $db->testHerokuDB();
    echo $something;
?>