<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loader::includeModule('alko.guarantee');
$arComponentParameters = [
    "GROUPS" => array(
	),
	"PARAMETERS" => array(
		"AJAX_MODE" => array(),
	),
];