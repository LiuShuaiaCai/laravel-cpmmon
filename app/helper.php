<?php


if (!function_exists('uuid')) {
    function uuid(): string
    {
        $chars = md5(uniqid((string)mt_rand(), true));
        $uuid  = substr($chars, 0, 8) . '-'
            . substr($chars, 8, 4) . '-'
            . substr($chars, 12, 4) . '-'
            . substr($chars, 16, 4) . '-'
            . substr($chars, 20, 12);
        return md5($uuid);
    }
}

if (!function_exists('getIp')) {
    function getIp(): string
    {
        $ip = '127.0.0.1';
        if (isset($_SERVER['SSH_CONNECTION'])) {
            $ips = explode(" ", $_SERVER['SSH_CONNECTION']);
            $ip  = $ips[0];
        }

        return $ip;
    }
}