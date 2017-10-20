<?php
require("funcs.php");
require("funcs/dbFuncs.php");

if (isset($_POST['inpShopName']) && !empty($_POST['inpShopUrl'])) {
    $shopName = htmlspecialchars($_POST['inpShopName']);
    $shopFriendlyName = htmlspecialchars($_POST['inpShopFriendlyName']);
    $shopUrl = htmlspecialchars($_POST['inpShopUrl']);
    $msgSavingResult = saveShopInDb($shopName, $shopFriendlyName, $shopUrl);
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css" />
    <title>Добавление магазина</title>
</head>
<body>
<div class="container">
    <div class="masthead">
        <?php printNavBar(); ?>
    </div>
    <?php
    if (isset($msgSavingResult)) {
        echo '<div class="row">';
        echo '<div class="alert alert-success ml-auto mr-auto">';
        echo $msgSavingResult;
        echo '</div>';
        echo '</div>';
    }
    ?>
    <div class="row">
        <div class="col-8 ml-auto mr-auto">
        <form action="addshop.php" method="post">
            <div class="form-group">
                <label for="inpShopName">Название магазина латиницей:</label>
                <input class="form-control" name="inpShopName" id="inpShopName" type="text">
            </div>
            <div class="form-group">
                <label for="inpShopFriendlyName">Название магазина на русском:</label>
                <input class="form-control" name="inpShopFriendlyName" id="inpShopFriendlyName" type="text">
            </div>
            <div class="form-group">
                <label for="inpShopUrl">Адрес сайта:</label>
                <input class="form-control" name="inpShopUrl" id="inpShopUrl" type="text">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        </div>
    </div>
</div>
<?php printFooterScripts(); ?>
</body>
</html>
