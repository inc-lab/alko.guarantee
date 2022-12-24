<?  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	if(isset($_POST['code'])){
		$APPLICATION->IncludeComponent(
			"guarantee_users:getfilter","",array(
				'PROP'=>'CML2_ARTICLE',
				'IBLOCK_ID'=>23,
				'CODE'=>$_POST['code']
			)
		);
	}
?>