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
    include 'connection.php';
    $name = $_GET['name'];
    $cursor = $client->find(['name' => $name]);
    $result = "Сообщения от клиента:<ol>";
    foreach ($cursor as $document) {
        $name = $document['name'];
        $IP = $document['ip'];
        $balance = $document['balance'];
        $message = $document['message'];
        if(is_object($message)){
            $message = (array)$message;
            $message = (implode(' & ', $message));
        }
        $result .=  "<li>Имя: $name,  сообщения: $message </li>";
    }
    $result .= "</ol>";
    echo $result;
    echo "<script> localStorage.setItem('$name', '$result');</script>";
    ?>
</body>
</html>