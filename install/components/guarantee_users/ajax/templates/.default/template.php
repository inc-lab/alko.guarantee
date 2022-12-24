<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
Текущее время: <?print_r($arResult);?>
<a href="<?=$_SERVER["REQUEST_URI"]?>">Обновить!</a>