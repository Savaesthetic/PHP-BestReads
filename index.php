<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css" />
    <title>Best Reads</title>
</head>
<body onload="showAllCovers()">
    <div class="header">
        <div>
            <span>bestreads</span>
        </div>
        <span class="back" onclick="showAllCovers()">home</span>
    </div>
    <div id="content"></div>

    <script>
        function showAllCovers() {
            var ajax = new XMLHttpRequest();
            ajax.open('GET', 'bestreads.php?load=covers', true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status == 200) {
                    var covers = JSON.parse(ajax.responseText);
                    var html = "";
                    for (var i = 0; i < covers.length; i++) {
                        html += "<img class=onebook onClick=bookInfo(this) src=" + covers[i] + ">";
                    }
                    var div = document.getElementById("content");
                    div.innerHTML = html;
                }
            }
        }
        
        function bookInfo(element) {
            var arr = element.src.match(/.*\/(books\/.*\/)cover.jpg/);
            var ajax = new XMLHttpRequest();
            ajax.open('GET', 'bestreads.php?load=' + arr[1], true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status == 200) {
                    var div = document.getElementById("images");
                    div.innerHTML = ajax.responseText;
                }
            }
        }

        function testDB() {
            var ajax = new XMLHttpRequest();
            ajax.open('GET', 'controller.php', true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status == 200) {
                    const response = ajax.responseText;
                    console.log(response);
                }
            }
        }
    </script>
</body>
</html>