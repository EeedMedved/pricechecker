<?php
require ("funcs.php");
require("funcs/dbFuncs.php");

if (isset($_GET['goodId'])) {
    $msgResultDeleting = deleteGood($_GET['goodId']);
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
    <title>Удаление товара</title>
</head>
<body>
<div class="container">
    <div class="masthead">
    <?php printNavBar(); ?>
    </div>
    <h1><?php echo $msgResultDeleting; ?></h1>
</div>
<?php printFooterScripts(); ?>
</body>
</html>
