<?php

// ======================== Functions ========================
// Function: A function to clean up the input form
function cleanPost($POST_FormName){
    // ======== Declaring Variables ========
    $strUncleaned = filter_input(INPUT_POST, $POST_FormName);

    // ======== Start of Function ========
    // Cleaning
    $strHTML = htmlentities($strUncleaned);
    $strSpecialChars = htmlspecialchars($strHTML);
    $strTrimmed = trim($strSpecialChars);

    // Return
    return($strTrimmed);
    }

// Function: A function to encrypt a certain string
function strEncrypt(string $strInput) {
    // ======== Declaring Variables ========
    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // 24-byte nonce
    $key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); // 256-bit key

    
    // ======== Start of Function ========
    // Encrypt
    $encCipherText = base64_encode(sodium_crypto_secretbox($strInput, $nonce, $key));
    $encNonce = base64_encode($nonce);
    $encKey = base64_encode($key);

    for ($i = 0; $i < 3; $i++){
        $encCipherText = base64_encode($encCipherText);
        $encNonce = base64_encode($encNonce);
        $encKey = base64_encode($encKey);

    }
    $returnArray = array($encCipherText, $encNonce, $encKey);
    // Return
    return($returnArray);
    }

// Function: A function to decrypt a certain string
function strDecrypt(string $strInput, string $encNonce, string $encKey) {
    // ======== Declaring Variables ========
    // Decrypt
    for ($i = 0; $i < 3; $i++){
        $strInput = base64_decode($strInput);
        $encNonce = base64_decode($encNonce);
        $encKey = base64_decode($encKey);
    }

    $plaintext = sodium_crypto_secretbox_open(base64_decode($strInput), base64_decode($encNonce), base64_decode($encKey));
    // ======== Start of Function ========

    // Return
    return($plaintext);
    }