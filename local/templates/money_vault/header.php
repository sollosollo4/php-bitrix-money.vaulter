<?php
global $APPLICATION;
global $USER;

use Bitrix\Main\Page\Asset;
\Bitrix\Main\Loader::includeModule('iblock');

$isUserAdmin = $USER->IsAdmin();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="" type="image/png"/>
	<title><?$APPLICATION->ShowTitle();?></title>
    <?
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/main.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/notiflix-2.7.0.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/dashboard.css');
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <?$APPLICATION->ShowHead();?>
</head>
<body>
<?if($isUserAdmin)  $APPLICATION->ShowPanel();?>