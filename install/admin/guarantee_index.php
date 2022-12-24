<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php';
$APPLICATION->IncludeComponent(
		"guarantee_users:add_admin","",array(
			'LID'=>'s1',
			'ADD'=>$_POST
		)
	);

if(isset($_POST['delete'])){
	$APPLICATION->IncludeComponent(
            "guarantee_users:delete","",array('ID'=>(int)$_POST['ID'],'IMG'=>$_POST['IMG']),false
        );

}
if(isset($_POST['update'])){
 $APPLICATION->IncludeComponent(
	"guarantee_users:update","",array(
		'LID'=>'s1',
		'UP'=>$_POST
		)
 );
}
if(isset($_POST['filter'])){
	unset($_POST['filter']);
	$APPLICATION->IncludeComponent(
		"guarantee_users:get_admin","",array(
			'LID'=>'s1',
			'FILTER'=>$_POST
			)
	 );
}
else{
	$APPLICATION->IncludeComponent(
		"guarantee_users:get_admin","",array(
			'LID'=>'s1'
			)
	 );
}
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php';
