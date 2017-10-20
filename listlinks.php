<?php
require('funcs/dbFuncs.php');
require ('funcs.php');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <title>Список ссылок</title>
</head>
<body>
<div class="container">
    <div class="masthead">
        <?php printNavBar(); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-stripped">
                <tr>
                    <td>ID</td>
                    <td>Товар</td>
                    <td>Ссылка</td>
                </tr>
            <tbody>
            <?php
            $links = getGoodLinks();
            foreach($links as $goodLink) {
                echo "<tr><td>";
                echo $goodLink['id'];
                echo "</td><td>";
                echo $goodLink['goodName'];
                echo "</td><td>";
                echo $goodLink['url'];
                echo "</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php printFooterScripts(); ?>
</body>
</html>