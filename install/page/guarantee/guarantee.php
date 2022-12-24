<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(isset($_GET['number']) && isset($_GET['article'])){
	$APPLICATION->IncludeComponent(
		"guarantee_users:img","",array(
			'LID'=>'s1',
			'NUMBER'=>$_GET['number'],
			'ARTICLE'=>$_GET['article'],
			'IBLOCK_ID'=>23,
			'PROP'=>'CML2_ARTICLE'
		)
	);
}
?>