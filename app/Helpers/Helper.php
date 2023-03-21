<?php

if (!function_exists('setErrorResponse')) {

    function setErrorResponse($message = '', $meta = null)
    {
        $response = [];
        $response['error']['message'] = $message;
        $response['error']['meta'] = $meta;
        return $response;
    }
}
if (!function_exists('setResponse')) {

    function setResponse($meta = null)
    {
        $response = [];
        $response['data'] = null;
        $response['extra_meta'] = $meta;
        return $response;
    }
}

if (!function_exists('encryptId')) {
    /**

     * This function encryptes the Id
     * @param $plainText
     * @param string $key
     * @param string $iv
     * @return string
     */
    function encryptId($plainText, $key = '', $iv = '')
    {
        $encryption_key = $key ? $key : config('constants.encrypt_decrypt.ENCRYPTION_SECRET_KEY');
        $encryption_iv  = $iv ? $iv : config('constants.encrypt_decrypt.ENCRYPTION_IV');
        return base64_encode(openssl_encrypt($plainText, config('constants.encrypt_decrypt.ENCRYPTION_TYPE'), $encryption_key, OPENSSL_RAW_DATA, $encryption_iv));
    }
}

if (!function_exists('decryptId')) {
    /**

     * This function decrypts the id
     * @param $encrypted
     * @param string $key
     * @param string $iv
     * @return false|string
     */
    function decryptId($encrypted, $key = '', $iv = '')
    {
        $encryption_key = $key ? $key : config('constants.encrypt_decrypt.ENCRYPTION_SECRET_KEY');
        $encryption_iv  = $iv ? $iv : config('constants.encrypt_decrypt.ENCRYPTION_IV');
        return openssl_decrypt(base64_decode($encrypted), config('constants.encrypt_decrypt.ENCRYPTION_TYPE'), $encryption_key, OPENSSL_RAW_DATA, $encryption_iv);
    }
}
