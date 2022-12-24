<input type="button" class="create-but" value="Создать">
<br>
<div class="list-get">
<form action="" method="post" class="filters">
	<?foreach($arResult['filter'] as $key=>$field){?>
		<?=$field;?>
	<?}?>
	<div class="up-but">
		<input type="submit" name="filter" value="Найти">
	</div>
</form>
<?
if(!$arResult['error']){?>
<div class="isdiscount">
	<?foreach($arResult['res'] as $item){?>
	<form action="" enctype="multipart/form-data"  method="post">
		<?foreach($item as $key=>$field){?>
			<?=$field;?>
		<?}?>
		<div class="up-but">
			<input type="submit" name="delete" class="is_coupon" value="Удалить">
			<input type="submit" name="update" class="is_coupon" value="Обновить">
		</div>
	</form>
	<?}?>
</div>
<?
}
else{
    header("HTTP/1.1 404 Not Found");
    echo json_encode($arResult);
}
?>
</div>

