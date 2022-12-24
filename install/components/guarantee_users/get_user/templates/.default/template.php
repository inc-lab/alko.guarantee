<div class="checkoutAlko">
	<?if(isset($arResult['form'][0]['ARTICLE'])){?>
		<h3 class="h3alko">Сведения о покупке</h3>
	    <form method="post" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">
			<?foreach($arResult['form'] as $key=>$item){?>
				<span>
					<?if(is_string($item)){?>
						<?=$item;?>
					<?}?>
				</span>
			<?}?>
		</form>
		<div class="ajaxAlko"></div>
	<?}else{?>
		<div class="no_check">Гарантия не найдена</div>
	<a href="/guarantee/check.php" class="is_check">Проверить еще раз</a>
	<?}?>
</div>