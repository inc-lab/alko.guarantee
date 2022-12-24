<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?$APPLICATION->SetTitle('Запрос успешно отправлен');?>
<p>
	Заявка на регистрацию электронной гарантии успешно отправлена. После проверки вам придет электронное письмо на почту с подтверждением.
</p>
<p>
	Так же вы можете проверить статус гарантии на странице <a href="/guarantee/check.php">Проверки гарантии</a>
</p>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>