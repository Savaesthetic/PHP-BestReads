<?php
    require_once './model.php';
    $db = new Model();

    if (isset ($_GET['load']) && $_GET['load'] === 'covers') {
        $arr = $db->getAllImages();
        unset($_GET ['load']);
        $result = '';
        foreach ($arr as $src) {
            $result .= "<img class=onebook onClick=bookInfo(this) src=" . $src['image'] . " >";
        }
        echo $result;
    } else if (isset ($_GET['load']) && isset ($_GET['image']) && $_GET['load'] === 'modal') {
        $book = $db->getBook($_GET['image']);
        $html = "<div class=onereview>";
        $html .= "<img src=" . $book['image'] . " >";
        $html .= "<div class=thedetails>";
        $html .= "<b>" . $book['title'] . "</b><br>by " . $book['author'];
        $html .= "<p>" . $book['description'] . "</p>";
        $html .= "<b>" . $book['reviewer'] . " ";
        for ($i = 0; $i < $book['rating']; $i++) {
            $html .= "*";
        }
        $html .= "</b><br>" . $book['review'];
        $html .= "</div></div>";
        echo $html;
    } else {
        $arr = $db->testHerokuDB();
        $result = '';
        foreach ($arr as $book) {
            $result .= implode(",", $book);
        }
        echo $result;
    }
?>