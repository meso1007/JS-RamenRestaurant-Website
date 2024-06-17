<?php
function encryptConfig($plaintext, $key) {
    $cipher = "aes-256-cbc"; 
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $encrypted = base64_encode($iv . $ciphertext); // IVと暗号文を連結してエンコード
    return $encrypted;
}
function decryptConfig($encrypted, $key) {
    $cipher = "aes-256-cbc"; 
    $encrypted = base64_decode($encrypted);
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = substr($encrypted, 0, $ivLength);
    $ciphertext = substr($encrypted, $ivLength);
    $plaintext = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    return $plaintext;
}


?>