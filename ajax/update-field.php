<?php 
define('WP_USE_THEMES', false); require('../../../../wp-blog-header.php');

$field = $_POST['field'];
$value = $_POST['val'];

update_option( $field, $value );

echo $value;


?>