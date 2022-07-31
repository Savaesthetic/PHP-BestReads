<?php
    require_once './model.php';
    $db = new Model();

    if (isset ( $_GET ['todo'] ) && $_GET ['todo'] === 'getQuotes') {
        $arr = $theDBA->getAllQuotations();
        unset($_GET ['todo']);
        echo getQuotesAsHTML ( $arr );
    } else {
        $arr = $db->testHerokuDB();
        $result = '';
        foreach ($arr as $book) {
            $result .= implode(",", $book);
        }
        echo $result;
    }
?>