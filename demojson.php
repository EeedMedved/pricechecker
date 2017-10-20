<?php
/**
 * Created by PhpStorm.
 * User: sennator
 * Date: 9/21/17
 * Time: 10:45 AM
 */
require("funcs/dbFuncs.php");

$shops = getShops();
$json = array("name" => $shops[0]['friendly_name'], 'url' => $shops[0]['url']);

/* Output header */
header('Content-type: application/json');
echo json_encode($json);