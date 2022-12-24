<div class="checkoutAlko">
<h3>Сведения о покупке</h3>
<p>Информация необходима для сопоставления данных и дальнейшей обработки для предоставления гарантийных и постгарантийных услуг. Подробнее о работе с персональными данными вы можете прочитать тут.</p>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>">
		<label class="nameFormAlko">Клиент:</label>
		<input type="text" name="USER" class="user" placeholder="Фамилия Имя Отчество">
		<label class="nameFormAlko">Название магазина:</label>
		<input type="text" name="SHOP" class="shop" placeholder="Название магазина">
		<label class="nameFormAlko">Адрес магазина:</label>
		<input type="text" name="ADRESS" class="adress" placeholder="Улица, номер дома">
		<label class="nameFormAlko">Город:</label>
		<input type="text" name="CITY" class="city" placeholder="Город">
		<label class="nameFormAlko">Сайт магазина:</label>
		<input type="text" name="SITE" class="site" placeholder="Сайт магазина">
		<label class="nameFormAlko">Серийный номер или код:</label>
		<input type="text" name="NUMBER" class="number" placeholder="Серийный номер">
		<label class="nameFormAlko">Дата покупки:</label>
		<input type="date" name="TIME" class=time" placeholder="Дата покупки">
		<label class="nameFormAlko">Номер чека:</label>
		<input type="text" name="CHECK" class="check" placeholder="Номер чека">		
		<label class="nameFormAlko">Фото чека:</label>
		<input type="file" name="check_photo" class="form-control" placeholder="Фото чека" accept="image/*" >
		<input type="button" class="registrAlko" value="Зарегистрировать">
	</form>
	<div class="ajaxAlko"></div>
</div>