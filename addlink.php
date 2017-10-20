<?php
require ("funcs.php");
require("funcs/dbFuncs.php");

if (isset($_POST['cmbGoods']) && !empty($_POST['inpGoodLink'])) {
    $goodId = htmlspecialchars($_POST['cmbGoods']);
    $linkGood = htmlspecialchars($_POST['inpGoodLink']);
    $msgAddingResult = saveLink($goodId, $linkGood);
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
    <title>Добавление ссылки</title>
</head>
<body>
<div class="container">
    <div class="masthead">
        <?php printNavBar(); ?>
    </div>
    <?php
    if (isset($msgAddingResult)) { ?>
        <div class="row">
            <div class="alert alert-success ml-auto mr-auto">
            <?php echo $msgAddingResult; ?>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="row">
        <form action="addlink.php" method="post">
            <div class="form-group">
                <label for="cmbGoods">Выберите товар:</label>
                <select class="form-control" id="cmbGoods" name="cmbGoods">
                    <?php
                    $goods = getGoods();
                    foreach ($goods as $id => $name) {
                        echo "<option value='$id'>" . $name . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inpGoodLink">Введите ссылку товара в магазине:</label>
                <input class="form-control" name="inpGoodLink" id="inpGoodLink" type="text">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>
<?php printFooterScripts(); ?>
</body>
</html>
