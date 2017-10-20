<?php
/**
 * Created by PhpStorm.
 * User: sennator
 * Date: 9/15/17
 * Time: 1:00 PM
 */
require ("funcs.php");
require ("funcs/dbFuncs.php");
if (!isset($_GET['id'])) {
    echo "Нет ид товара.";
    exit;
}

$goodId = htmlspecialchars($_GET['id']);
$prices = getActualPrices($goodId);
$goodName = getGoodName($goodId);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <title><?php echo $goodName; ?></title>
</head>
<body>
<div class="container">
    <div class="masthead">
        <?php printNavBar(); ?>
    </div>
    <div class="row">
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>Магазин</th>
                <th>Цена</th>
                <th>Последнее обновление цены</th>
                <th></th>
            </tr>
            </thead>
            <?php foreach ($prices as $price) { ?>
                <tr>
                    <td><?php echo $price['shopname']; ?></td>
                    <td><?php echo $price['price']; ?></td>
                    <td><?php echo $price['round_time']; ?></td>
                    <td><a href="<?php echo getGoodLink($goodId, $price['shop_id']); ?>" class="btn btn-outline-primary">Перейти</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php printFooterScripts(); ?>
</body>
</html>
