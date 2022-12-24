<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->SetTitle('Гарантия на товар');?>
<?php
	$APPLICATION->IncludeComponent(
		"guarantee_users:add","",array(
			'LID'=>'s1',
			'ADD'=>$_POST,
			'IBLOCK_ID'=>23,
			'PROP'=>'CML2_ARTICLE'
		)
	);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>