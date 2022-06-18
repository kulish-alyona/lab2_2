<?php include "connection.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лаба2</title>
    <script>
        function action1() {
            let client = document.getElementById("name").value;
            let result = localStorage.getItem(client);
            document.getElementById('res').innerHTML = result;
        }
    </script>
</head>
<body>
<form action="action1.php" method="get">
    <p><strong> Сообщения от выбранного клиента: </strong>
            <select name="name" id="name" onchange="action1()">
                <?php
                    $find = $client->distinct("name");
                    foreach ($find as $document) {
                        echo "<option>$document</option>";
                    }
                ?>
            </select>
        <button>ОК</button>
    </p>
</form>
<form action="" method="get">
<p><strong>Общий входящий и исходящий трафик:</strong>
<input type="hidden" id="custId" name="custId" value="3487">
    <button>ОК</button>
</p>
</form>

<form action="" method="get">
<p><strong> Вывести людей с отрицательным балансом </strong>
<input type="hidden" id="custId1" name="custId1" value="3486">
    <button>ОК</button>
</p>
</form>
<?php
    if(isset($_GET["custId"])){
        include 'connection.php';
        $cursor = $seance->find();
        $resIN = 0;
        $resOut = 0;
        foreach ($cursor as $document) {
            $in = $document['traffic_in'];
            $out = $document['traffic_out'];
            $resIN += $in;
            $resOut += $out;
        }
        $result = "Общий входящий трафик: <b>$resIN</b> и исходящий трафик: <b>$resOut</b>";
        echo $result;
}
    if(isset($_GET["custId1"])){
    include 'connection.php';
    $rangeQuery = ['balance' => ['$lt' => 0]];
    $cursor = $client->find($rangeQuery);
    $result = "Пользователи с отрицательным балансом:<ol>";
    foreach ($cursor as $document) {
        $name = $document['name'];
        $balance = $document['balance'];
        $result .=  "<li>Имя: <b>$name</b>, balance: <b>$balance</b></li>";
    }
    $result .= "</ol>";
    echo $result;
}
?>
<div id="res">Local Storage</div>
</body>
</html>