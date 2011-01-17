<?
require_once '/var/www_libs/aws-sdk-for-php/sdk.class.php';

// Instantiate
$nc['extensions']['simpledb'] = new AmazonSDB();
?>