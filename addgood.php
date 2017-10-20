<?php
require("funcs.php");

if (isset($_POST['inpGoodName']) && !empty($_POST['inpGoodName'])) {
    $goodName = htmlspecialchars($_POST['inpGoodName']);


    $mysqli = new mysqli('127.0.0.1', 'testuser', 'Kursk%15', 'testdb');

    if ($mysqli->connect_errno) {
        echo "Error: Failed to make a MySQL connection, here is why: \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";

        exit;
    }

    $sqlQuery = "INSERT INTO goods (name) VALUES('$goodName')";

    $result = $mysqli->query($sqlQuery);

    if ($result) {
        echo "Сохранено!";
    } else {
        echo "Не сохранено!";
    }

    // echo $sqlQuery;
}

// $mysqli -> query($sqlQuery);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <title></title>
</head>
<body>
<div class="container-fluid">
    <div class="masthead">
        <?php printNavBar(); ?>
    </div>
    <div class="row">
        <div class="col-8 ml-auto mr-auto">
            <form action="addgood.php" method="post">
                <fieldset>
                    <legend>Ввод товара:</legend>
                    <div class="form-group">
                        <label for="inpGoodName">Название товара:</label>
                        <input class="form-control" name="inpGoodName" id="inpGoodName"
                               placeholder="Введите название товара" type="text">
                    </div>
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php printFooterScripts(); ?>
</body>
</html>
