<?php
require ("funcs.php");
require("funcs/db_conn.php");

$mysqli = new mysqli($db_host, $db_login, $db_password, $db_name);
if ($mysqli -> connect_errno) {
    echo "Errno: " . $mysqli -> connect_errno . "\n";
}
$sqlQuery = "SELECT id, name FROM goods";

if (!$result = $mysqli -> query($sqlQuery)) {
    echo "Error. Query failed to execute. \n";
    echo "Errno: " . $mysqli -> errno . "\n";
    echo "Error: " . $mysqli -> error . "\n";
    exit;
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <title>Справочник товаров</title>
</head>
<body>
<div class="container">
    <div class="masthead">
        <?php printNavBar(); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <td>ID</td>
                <td>Товар</td>
                <td>Удалить</td>
            </tr>
                <?php
                while ($good = $result -> fetch_assoc()) {
                    echo '<tr><td>';
                    echo $good['id'];
                    echo '</td><td>';
                    echo $good['name'];
                    echo '</td><td><a href="deletegood.php?goodId=' . $good['id'] . '" class="btn btn-danger">Удалить</a>';
                    echo '</td></tr>';
                }
                ?>
        </table>
    </div>
</div>
<?php printFooterScripts(); ?>
</body>
</html>