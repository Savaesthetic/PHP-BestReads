<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Reads</title>
</head>
<body onload="testDB()">

    <script>
        function testDB() {
            var ajax = new XMLHttpRequest();
            ajax.open('GET', 'controller.php', true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status == 200) {
                    const response = ajax.responseText;
                    console.log(typeof response);
                    if (Array.isArray(response)) {
                        console.log(response.join);
                    } else {
                        console.log(response);
                    }
                }
            }
        }
    </script>

</body>
</html>