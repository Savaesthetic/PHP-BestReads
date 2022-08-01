<?php
    require_once './model.php';
    $db = new Model();

    if (isset ( $_GET ['load'] ) && $_GET ['load'] === 'covers') {
        $arr = $db->getAllImages();
        unset($_GET ['load']);
        $result = '';
        foreach ($arr as $src) {
            $result .= "<img class=onebook onClick=bookInfo(this) src=" . $src['image'] . " >";
        }
        echo $result;
    } else {
        $arr = $db->testHerokuDB();
        $result = '';
        foreach ($arr as $book) {
            $result .= implode(",", $book);
        }
        echo $result;
    }
?>