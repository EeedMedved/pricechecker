<?php
/**
 * Created by PhpStorm.
 * User: sennator
 * Date: 9/14/17
 * Time: 2:19 PM
 */
require("funcs.php");
require("funcs/dbFuncs.php");
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css"/>
    <title>Цена на жёсткие диски</title>
</head>
<body>
<div class="container">
    <div class="masthead">
        <?php //printNavBar(); ?>
    </div>
    <div class="row">
        <?php $goods = getActualPrices(16); ?>
        <table class="table">
            <thead class="thead-inverse">
                <tr>
                    <th>Магазин</th>
                    <th>Цена</th>
                    <th>Последнее обновление цены</th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach ($goods as $good) { ?>
                <tr>
                    <td><?php echo $good['shopName']; ?></td>
                    <td><?php echo $good['price']; ?></td>
                    <td><?php echo $good['round_time']; ?></td>
                    <td><a href="<?php echo getGoodLink(16, $good['shop_id']); ?>" class="btn btn-outline-primary">Перейти</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php printFooterScripts(); ?>
</body>
</html>