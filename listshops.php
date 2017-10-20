<?php
/**
 * Created by PhpStorm.
 * User: sennator
 * Date: 9/15/17
 * Time: 10:55 AM
 */
require ("funcs.php");
require ("funcs/dbFuncs.php");

$shops = getShops();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <title>Список магазинов</title>
</head>
<body>
<div class="container">
    <div class="masthead">
        <?php printNavBar(); ?>
    </div>
    <div class="row">
        <h3>Список магазинов</h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Id</td>
                <td>Название магазина</td>
                <td>Служебное назавание (лат.)</td>
                <td>Ссылка на сайт</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($shops as $shop) { ?>
            <tr>
                <td><?php echo $shop['id']; ?></td>
                <td><?php echo $shop['friendly_name']; ?></td>
                <td><?php echo $shop['name']; ?></td>
                <td><?php echo $shop['url']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php printFooterScripts(); ?>
</body>
</html>
