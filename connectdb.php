<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $host = 'localhost';
        $dbname = 'Aniverse';
        $username = 'root';
        $password = '';

        try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        echo "Connected successfully to database";
        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
    ?>
</body>
</html>