<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 * @license    GNU V2
 */

if (! class_exists(\Omnipay\Payos\Gateway::class)) {
    class_alias(\Juzaweb\PayOs\Gateway::class, \Omnipay\Payos\Gateway::class);
}

function verifySignaturePayos($transaction, $transactionSignature, $checksumKey): bool
{
    ksort($transaction);
    $transactionStrArr = [];
    foreach ($transaction as $key => $value) {
        if (is_null($value) || in_array($value, ["undefined", "null"])) {
            $value = "";
        }

        if (is_array($value)) {
            $valueSortedElementObj = array_map(function ($ele) {
                ksort($ele);
                return $ele;
            }, $value);
            $value = json_encode($valueSortedElementObj, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        }
        $transactionStrArr[] = $key . "=" . $value;
    }

    $transactionStr = implode("&", $transactionStrArr);

    $signature = hash_hmac("sha256", $transactionStr, $checksumKey);

    return $signature == $transactionSignature;
}
