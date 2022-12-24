<?
use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<div class="checkoutAlko">


	 <?if($arResult['res']==2){?>
	<p class="red">
		 <?=Loc::getMessage('MYMODULE_NO_PROD');?>
	</p>
	 <?}?>
	 <?if($arResult['res']==5){?>
	<p class="red">
		 <?=Loc::getMessage('MYMODULE_REPEAT');?>
	</p>
	 <?}?>
	<!--<h3 class="h3alko"><?=Loc::getMessage('MYMODULE_TITLES');?></h3>
	<p class="s16"><?=Loc::getMessage('MYMODULE_INFO');?>
		</p>-->
	<div class="custom-alko">
<h4 class="text-center p-3">Максимальная безопасность благодаря
            расширенной гарантии на продукцию АЛ-КО / solo by АЛ-КО</h4>
          <p class="descr">Садовая техника АЛ-КО - это хороший выбор, это гарантия
            качества и удовольствия от работы, долгий срок службы. Вся техника
            разработана в Германии. Мы как производители гарантируем Вам
            автоматическую двухлетнюю гарантию. Продление гарантии до 4-х лет
            бесплатно при наличии гарантийного сертификата. После покупки
            зарегистрируйтесь на нашем сайте в течение 8 недель и заполните
            онлайн гарантийный формуляр.</p>
          <p>Ваши преимущества:</p>
          <ol>
            <li>4 года гарантии от производителя: Эксклюзивное продление
              гарантийного срока в общей сложности до 4-х лет
            </li>
            <li>Экономия: Если Вы используете устройство по назначению в
              соответствии с инструкцией по эксплуатации, дополнительных
              расходов на ремонт от Вас не потребуется.
            </li>
            <li>Единые стандарты: Расширенная гарантия распространяется на все
              устройства AL-KO и solo® by AL-KO, приобретенные на территории РФ,
              - независимо от того, где они были куплены в специализированной
              дилерской сети, в магазинах DIY или онлайн.
            </li>
            <li>Надежный сервис: Более 220 авторизированных сервисных центров по
              всей России и наличие Горячей линии окажут помочь в случае
              необходимости.
            </li>
          </ol>
          <p>Бесплатное продление расширенной гарантии распространяется только
            на садовую технику, изготовленную компанией AL-KO Geräte GmbH.</p>
          <p>Всё просто! 3 шага к получению расширенной гарантии 2+2:</p>
          <ol>
            <li>Перед эксплуатацией изделия обязательно ознакомьтесь с
              инструкцией по эксплуатации и условиями действия гарантийных
              обязательств
              <a href="/help/warranty/">от
                производителя.</a></li>
            <li>Купите инструмент и заполните нашу форму онлайн в течение 4
              недель с момента покупки.
            </li>
            <li>АЛ-КО проверит Ваши данные и отправит Вам подтверждение
              продления гарантии по указанной электронной почте.
            </li>
            <li>Распечатайте подтверждение и гарантийный сертификат для
              предъявления в сервисный центр в случае необходимости.
            </li>
          </ol>
          <h4 class="text-center p-3">Сведения о продукте</h4>
          <p class="text-center">Необходимую информацию Вы найдете на заводской
            табличке Вашего продукта AL-KO и Гарантийном талоне.</p>
        </div>

        <div class="row">
          <div class="col-lg-6 text-center">
            <p>Первый вариант шильдика</p>
			  <img src="/bitrix/components/guarantee_users/add/templates/.default/img/label1.jpg" alt="Первый вариант шильдика" width="100%">
          </div>
          <div class="col-lg-6 text-center">
            <p>Второй вариант шильдика</p>
            <img src="/bitrix/components/guarantee_users/add/templates/.default/img/label2.jpg" alt="Второй вариант шильдика" width="100%">
          </div>
</div>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="guarantee" enctype="multipart/form-data">
	 <?foreach($arResult['form'] as $key=>$item){?> <span>
		 <?if(!filter_var($arParams['ADD']['EMAIL'], FILTER_VALIDATE_EMAIL) && $key=='EMAIL' && $arParams['ADD']['EMAIL']!=''){?><span class="red def">E-mail не валиден</span><?}?><?if(isset($_POST[$key]) && $_POST[$key]=='' && isset($req[$key])){?> <span class="red def"><?=Loc::getMessage('MYMODULE_REQ');?></span>
		<?}?> <?echo $item;?> </span>
		<?}?> <input type="submit" class="registrAlko" value="Зарегистрировать">
	</form>
	<div class="ajaxAlko">
	</div>
</div>
 <br>