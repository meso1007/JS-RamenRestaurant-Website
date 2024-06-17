<?php
$configData = file_get_contents('./config.php');
$key = 'YourEncryptionKey';

$encryptedData = encryptConfig($configData, $key);

file_put_contents('./data/encrypted_config.txt', $encryptedData);


?>