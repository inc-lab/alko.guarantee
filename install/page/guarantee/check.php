<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->SetTitle('Проверка гарантии на товар');?>
<?if(empty($_POST['NUMBER'])){?>
<style>
form[action="/guarantee/check.php"] {
    width: 100%;
    display: block;
}
.red.def{
	display: block;
    text-decoration: underline;
    font-size: 12px;
}
.checkoutAlko p.code_no {
    color: red;
    text-align: center;
    padding-top: 20px;
    font-size: 20px;
}
.def ~ input{
	border:1px solid red !important;
}
.red{
	color:red;
}
.checkoutAlko p.red {
    color: red;
    text-align: center;
    padding-top: 20px;
}

.checkoutAlko {
    font-size: 0px;
}

label.nameFormAlko {
    width: max-content;
    display: inline-block;
    vertical-align: top;
		padding:20px;
}
input.registrAlko {
    border: 1px solid #dc2f2f !important;
    background: #dc2f2f !important;
    border-radius: 3px;
    height: 58px !important;
    color: #ffffff;
    margin: 0 auto;
    position: relative;
    display: block;
    font-size: 16px;
}
form[action="/guarantee/check.php"] input {
    width: 25%;
    margin-top: 12px;
    border: 1px solid #ececec;
    border-radius: 3px;
    background: #f8f8f8;
    height: 35px;
    padding-left: 12px;
}
@media only screen and (max-width:1000px) and (min-width:200px) {
	form[action="/guarantee/check.php"] input {
		width: calc(100% - 20px);
    	margin-top: 0px;
	}
	
	label.nameFormAlko {
		width: 100%;
		display: block;
    	padding: 8px;
	}
	form[action="/guarantee/check.php"] input {
		width: 100%;
		margin-top: 20px;
		padding-left: 0px;
	}
}
</style>
<div class="checkoutAlko">
	<form action="<?=POST_FORM_ACTION_URI?>" method="post">
		<label class="nameFormAlko">Артикул товара <span class="red">*</span>:</label>
		<input type="text" name="ARTICLE" >
		<label class="nameFormAlko">Серийный номер <span class="red">*</span>:</label>
		<input type="text" name="NUMBER" >
		<input type="submit" class="registrAlko" value="Проверить">
	</form>
</div>
<?}else{?>
<?php
	$APPLICATION->IncludeComponent(
		"guarantee_users:get_user","",array(
			'LID'=>'s1',
			'ADD'=>$_POST,
			'IBLOCK_ID'=>23,
			'PROP'=>'CML2_ARTICLE'
		)
	);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>