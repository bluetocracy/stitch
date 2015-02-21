<?php
/******
 * Nothing to see here... 
 *
 ******/
require_once('channel_shopify.class.php');

$shopify = New Channel_Shopify;

$test = $shopify->returnLocalData();

echo "<pre>";
var_dump($test);
echo "</pre>";
// echo "<pre>" .  $test . "</pre></br>";

?>

<html>
<body>
Test EEEEE 12...3?!?
</body>
</html>