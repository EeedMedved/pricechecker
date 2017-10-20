<?php
/**
 * Created by PhpStorm.
 * User: sennator
 * Date: 10/19/17
 * Time: 6:46 PM
 */

require ("funcs/dbFuncs.php");

$shops = getShopsForGood(16);

//echo '<pre>' . var_dump($shops) . '</pre>';
?>

<table class="table">
    <tr>Дата</tr>
    <tr>Магазин</tr>
    <tr>Цена</tr>
<?php
foreach ($shops as $shop) {
    $price = getLatestPriceForGood(16, $shop);
    //var_dump($price);
    ?>
        <tr>
            <td>
                <?php echo $price['round_time']; ?>
            </td>
            <td>
                <?php echo $price['shop_id']; ?>
            </td>
            <td>
                <?php echo $price['price']; ?>
            </td>
        </tr>
    <?php
}
?>
</table>
