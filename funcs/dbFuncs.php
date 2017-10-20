<?php
require ("db_conn.php");

function dbConnect() {
    global $db_host, $db_login, $db_password, $db_name;
    $mysqli = new mysqli($db_host, $db_login, $db_password, $db_name);

    if ($mysqli -> connect_errno) {
        echo "Error: Failed to make a MySQL connection.\n";
        echo "Error: " . $mysqli -> connect_errno . "\n";
        echo "Error: " . $mysqli -> connect_error . "\n";

        exit;
    }

    return $mysqli;
}

function printDbError($sqlQuery) {
    global $mysqli;
    echo "Error: Query failed to execute. <br />";
    echo "Query: " . $sqlQuery . "<br />";
    echo "Errno: " . $mysqli->errno . "<br />";
    echo "Error: " . $mysqli->error . "<br />";
}

function saveLink($good_id, $linkUrl)
{
    $shops = getShops();
    foreach ($shops as $shop) {
        $shopUrl = str_replace("http://", "", $shop['url']);
        if (strpos($linkUrl, $shopUrl) == true) {
            $shopId = $shop['id'];
            break;
        }
    }

    if (!isset($shopId)) {
        print('Магазин не найден');
        exit;
    }

    $sqlQuery = "INSERT INTO links_catalog (good_id, url, shop_id) VALUES ('$good_id', '$linkUrl', ' $shopId')";
    //echo $sqlQuery;
    $mysqli = dbConnect();

    if ($result = $mysqli -> query($sqlQuery))
    {
        $msgResult = "Ссылка успешно сохранена.";
    }
    else
    {
        $msgResult = "Ошибка сохранения ссылки.";
    }

    return $msgResult;
}

function getGoods() {
    $sqlQuery = "SELECT id, name FROM testdb.goods";
    $mysqli = dbConnect();
    if (!$result = $mysqli->query($sqlQuery))
    {
        echo "Error: Query failed to execute. <br />";
        echo "Query: " . $sqlQuery . "<br />";
        echo "Errno: " . $mysqli->errno . "<br />";
        echo "Error: " . $mysqli->error . "<br />";
        exit;
    }

    $goods = array();
    while ($good = $result->fetch_assoc()) {
        $goods[$good['id']] = $good['name'];
    }

    return $goods;
}

function getGoodLinks() {
    $sqlQuery = "SELECT links_catalog.id, links_catalog.url, goods.name FROM testdb.links_catalog LEFT JOIN testdb.goods ON links_catalog.good_id = goods.id";
    $mysqli = dbConnect();
    if (!$result = $mysqli->query($sqlQuery)) {
        echo "Error: Query failed to execute. <br />";
        echo "Query: " . $sqlQuery . "<br />";
        echo "Errno: " . $mysqli->errno . "<br />";
        echo "Error: " . $mysqli->error . "<br />";
        exit;
    }

    $links = array();
    while ($link = $result->fetch_assoc()) {
        $tLink = array("id" => $link['id'], "goodName" => $link['name'], "url" => $link['url']);
        array_push($links, $tLink);
    }

    return $links;
}

function getGoodLink($goodId, $shopId) {
    $sqlQuery = "SELECT url FROM links_catalog WHERE good_id = $goodId AND shop_id = $shopId";
    $mysqli = dbConnect();
    if (!$result = $mysqli->query($sqlQuery)) {
        echo "Error: Query failed to execute. <br />";
        echo "Query: " . $sqlQuery . "<br />";
        echo "Errno: " . $mysqli->errno . "<br />";
        echo "Error: " . $mysqli->error . "<br />";
        exit;
    }

    $url = $result->fetch_assoc();
    return $url['url'];
}

function deleteGood($goodId) {
    $sqlQuery = "DELETE FROM goods WHERE id=" . $goodId;
    $mysqli = dbConnect();

    if ($result = $mysqli -> query($sqlQuery))
    {
        $msgResult = "Успешно удалено.";
    }
    else
    {
        $msgResult = "Ошибка удаления.";
    }

    /*$result->free();
    $mysqli->close();*/
    return $msgResult;
}

function saveShopInDb($shopName, $shopFriendlyName, $shopUrl) {
    $sqlQuery = "INSERT INTO shops (name, url, friendly_name) VALUES ('". $shopName
            . "', '" . $shopUrl . "', '" . $shopFriendlyName . "')";

    $mysqli = dbConnect();
    if ($result = $mysqli->query($sqlQuery)) {
        $msgResult = "Магазин успешно сохранен.";
    }
    else
    {
        $msgResult = "Ошибка сохранения магазина.";
    }

    return $msgResult;
}

// Функция возвращает список актуальных цен
function getActualPrices($goodId) {
    $shops = getShopsForGood($goodId);
    $prices = array();

    foreach($shops as $shop) {
        $price = getLatestPriceForGood($goodId, $shop);
        array_push($prices, $price);
    }

    return $prices;
}

// Возвращает название товара по его идентификатору
function getGoodName($goodId) {
    $sqlQuery = "SELECT name FROM goods WHERE id = $goodId";
    $mysqli = dbConnect();

    if (!$result = $mysqli->query($sqlQuery)) {
        printDbError($sqlQuery);
        exit;
    }

    $arrRes = $result->fetch_assoc();
    return $arrRes['name'];
}

// Возвращает список всех магазинов
function getShops() {
    $sqlQuery = "SELECT id, name, friendly_name, url FROM shops";
    $mysqli = dbConnect();

    if (!$result = $mysqli->query($sqlQuery)) {
        printDbError($sqlQuery);
        exit;
    }

    $shops = array();
    while ($shop = $result->fetch_assoc()) {
        array_push($shops, $shop);
    }

    return $shops;
}

// Возвращает список магазинов для товара, в которых этот товар был хоть раз
function getShopsForGood($goodId) {
    $sqlQuery = "SELECT DISTINCT shop_id FROM rounds WHERE good_id = $goodId";
    $mysqli = dbConnect();

    if (!$result = $mysqli->query($sqlQuery)) {
        printDbError($sqlQuery);
        exit;
    }

    $shops = array();
    while ($shop = $result->fetch_assoc()) {
        array_push($shops, $shop['shop_id']);
    }

    return $shops;
}

// Возвращает последнюю цену для указанного товара в указанном магазине
function getLatestPriceForGood($goodId, $shopId)
{

    $sqlQuery = "SELECT rounds.round_time, rounds.good_id, rounds.shop_id, rounds.price, shops.friendly_name as shopname 
    FROM rounds
    LEFT JOIN shops ON rounds.shop_id = shops.id
    WHERE shop_id = $shopId AND round_time IN (
        SELECT MAX(round_time)
        FROM rounds WHERE good_id = $goodId
        GROUP BY shop_id
        )";
    $mysqli = dbConnect();

    if (!$result = $mysqli->query($sqlQuery)) {
        printDbError($sqlQuery);
        exit;
    }

    $price = $result->fetch_assoc();
    if (!$price) {
        echo 'нет';
    }
    return $price;

}


