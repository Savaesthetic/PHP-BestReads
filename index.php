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
            ajax.open('GET', 'controller.php?load=covers', true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status == 200) {
                    var div = document.getElementById("content");
                    div.innerHTML = ajax.responseText;
                }
            }
        }
        
        function bookInfo(element) {
            const image = element.src;
            const regex = new RegExp('.*(/images.*)')
            const match = image.match(regex);
            const location = match[1];
            var ajax = new XMLHttpRequest();
            ajax.open('GET', 'controller.php?load=modal&image=' + location, true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status == 200) {
                    var div = document.getElementById("content");
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