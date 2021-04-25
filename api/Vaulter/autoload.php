<?php

require_once(__DIR__.'/CurlTransmitter/CurlTransmitter.php');
require_once(__DIR__.'/External/IExternalMoney.php');
require_once(__DIR__.'/External/ExternalVaulterCom.php');
require_once(__DIR__.'/MoneyVault/MoneyVault.php');

/*spl_autoload_register(function (string $className) {
    $path = __DIR__ .'\\'. str_replace('/','\\', $className).'.php';
    require $path;
});*/

